import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import Swal from 'sweetalert2';
import { forkJoin } from 'rxjs';
import { CategoryService } from 'src/app/services/category.service';
import { EventService } from 'src/app/services/event.service';

@Component({
  selector: 'app-transaction',
  templateUrl: './transaction.component.html',
  styleUrls: ['./transaction.component.scss'],
})
export class TransactionComponent implements OnInit {
  userInfo: any;
  categoryList: any;
  expenseForm!: FormGroup;
  type: string = 'Expense';
  selectedImage!: File;
  imagePath!: string;
  currentId!: number;
  formSubmitted: boolean = false;
  eventsList: any = [];
  expenseSuggestion: any = [];
  transactionData: any;
  eventUsers!: any[];
  categoryImagePath: string = '';
  members: any = [];
  constructor(
    private formBuilder: FormBuilder,
    private localStorageService: LocalStorageService,
    private bugetService: BudgetService,
    private eventService: EventService,
    private categoryService: CategoryService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
  ) {}

  ngOnInit(): void {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;

    this.activatedRoute.params.subscribe((params: Params) => {
      this.type = params['type'];
      this.currentId = parseInt(params['id_expense']);
    });

    this.expenseForm = this.formBuilder.group({
      name: ['', [Validators.required]],
      category: ['', [Validators.required]],
      amount: [
        '',
        [Validators.required, Validators.pattern(/^\d+(\.\d{1,2})?$/)],
      ],
      dateOfTransaction: [formattedDate, Validators.required],
      description: [''],
      id_event: [''],
      id: [null, [Validators.required]],
      type: [null, [Validators.required]],
      image: [null],
      members: [],
    });

    this.userInfo = this.localStorageService.getItem('userInfo');
    this.expenseForm.patchValue({ id: this.userInfo.id });
    this.expenseForm.patchValue({ type: this.type });
    this.getCategories();
    // this.getEventsList();
    // if edit mode get the details
    this.getDetails();
  }
  getDetails() {
    if (this.currentId) {
      forkJoin({
        details: this.bugetService.getDetails(this.currentId),
        events: this.eventService.events(),
      }).subscribe(
        ({ details, events }) => {
          // Update the events list with the latest data
          this.eventsList = events;

          // Process details data
          this.transactionData = details.data;
          const { data } = details;
          this.expenseForm.patchValue({
            id: data.id_expense,
            name: data.expense_name,
            category: data.id_category,
            amount: data.amount,
            dateOfTransaction: data.date_of_transaction,
            description: data.description,
            type: this.type,
            id_event: data.id_event,
            members: details.members.map(
              (member: { id_member: string }) => member.id_member,
            ),
          });

          // Process events data
          const selectedEvent = this.eventsList.find(
            (e: any) => e.id_event === parseInt(data.id_event, 10),
          );
          if (selectedEvent) {
            this.members = selectedEvent.members;
          }

          this.imagePath = details.imagePath;
        },
        (error) => {
          console.error('Error fetching data:', error);
        },
      );
    } else {
      this.eventService.events().subscribe(
        (response) => {
          this.eventsList = response;
        },
        (error) => {},
      );
    }
  }

  getCategories() {
    this.categoryService.categoryList(this.type).subscribe(
      (response) => {
        this.categoryImagePath = response.categoryImagePath;
        this.categoryList = response.list;
      },
      (error) => {},
    );
  }

  onEventSelect(event: Event) {
    const selectedValue = (event.target as HTMLSelectElement).value;
    const selectedEvent = this.eventsList.find(
      (e: any) => e.id_event === parseInt(selectedValue, 10),
    );
    this.members = selectedEvent.members;
  }

  onSubmit() {
    this.formSubmitted = true;
    if (this.expenseForm.valid) {
      const formData = new FormData();
      formData.append('name', this.expenseForm.value.name);
      formData.append('category', this.expenseForm.value.category);
      formData.append('amount', this.expenseForm.value.amount);
      formData.append(
        'dateOfTransaction',
        this.expenseForm.value.dateOfTransaction,
      );
      formData.append('description', this.expenseForm.value.description);
      formData.append('id', this.expenseForm.value.id);
      formData.append('id_event', this.expenseForm.value.id_event);

      formData.append('type', this.expenseForm.value.type);
      formData.append('image', this.selectedImage);
      formData.append(
        'members',
        JSON.stringify(this.expenseForm.value.members),
      );

      if (this.currentId) {
        this.bugetService.updateExpense(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      } else {
        this.bugetService.addExpense(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      }
    }
  }

  navigateBack() {
    switch (this.type) {
      case 'expense':
        this.router.navigateByUrl('/expenses');
        break;
      case 'income':
        this.router.navigateByUrl('/income');
        break;
      case 'savings':
        this.router.navigateByUrl('/savings');
        break;
      default:
        break;
    }
  }

  onFileChange(event: any) {
    if (event.target.files.length > 0) {
      this.selectedImage = event.target.files[0];
    }
  }

  capitalizeFirstLetter(string: string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  delete() {
    Swal.fire({
      title: 'Are you sure?',
      text: `Want to Delete ${this.capitalizeFirstLetter(this.type)}`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Delete',
    }).then((result) => {
      if (result.isConfirmed) {
        this.bugetService.deleteTransaction(this.currentId).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              title: this.capitalizeFirstLetter(this.type),
              text: 'Transaction Deleted',
              showConfirmButton: false,
              timer: 1500,
            }).then((deleteResult) => {
              this.navigateBack();
            });
          },
          (error) => {
            Swal.fire({
              icon: 'error',
              title: this.capitalizeFirstLetter(this.type),
              text: 'Transaction Delete Failed!',
              showConfirmButton: false,
              timer: 1500,
            });
          },
        );
      }
    });
  }

  getSuggestions(param: any) {
    this.bugetService.getSuggestion(param.value).subscribe(
      (response) => {
        this.expenseSuggestion = response;
        // this.categoryList = response;
      },
      (error) => {},
    );
  }

  onOptionSelect(option: any) {
    this.expenseForm.patchValue({
      name: option.expense_name,
      category: option.id_category,
    });

    this.expenseSuggestion = [];
  }

  downloadImage() {
    const imageUrl = this.imagePath + this.transactionData.image;
    this.bugetService.downloadImage(imageUrl).subscribe((blob: Blob) => {
      const link = document.createElement('a');
      link.href = window.URL.createObjectURL(blob);
      link.download = 'downloaded-image.jpg';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  }

  isImageFile(fileName: string): boolean {
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    const fileExtension = this.getFileExtension(fileName);
    return imageExtensions.includes(fileExtension);
  }

  isPdfFile(fileName: string): boolean {
    const pdfExtensions = ['pdf'];
    const fileExtension = this.getFileExtension(fileName);
    return pdfExtensions.includes(fileExtension);
  }

  getFileExtension(fileName: string): string {
    return fileName.split('.').pop()?.toLowerCase() || '';
  }

  preventText($event: any) {
    const value = $event.target.value.replace(/[a-zA-Z%@*^$!`)(_+=#&\s]/g, '');
    $event.target.value = value;
  }
}
