import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-add-member',
  templateUrl: './add-member.component.html',
  styleUrls: ['./add-member.component.scss'],
})
export class AddMemberComponent implements OnInit {
  typeList: any;
  userInfo: any;
  categoryList: any;
  categoryImagePath!: string;
  memberForm!: FormGroup;
  selectedImage!: File;
  imagePath!: string;
  currentId!: number;
  formSubmitted: boolean = false;
  eventsList: any = [];
  expenseSuggestion: any = [];
  transactionData: any;
  eventUsers: any[] = [];
  constructor(
    private formBuilder: FormBuilder,
    private localStorageService: LocalStorageService,
    private eventService: EventService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.currentId = parseInt(params['id_member']);
    });

    this.memberForm = this.formBuilder.group({
      id_member: [''],
      firstname: ['', Validators.required],
      lastname: [''],
      phone_number: ['', [Validators.pattern('^[0-9]*$')]],
      id_customer: [''],
      date_created: [''],
      date_updated: [''],
    });

    this.userInfo = this.localStorageService.getItem('userInfo');
    this.memberForm.patchValue({ id: this.userInfo.id });
    // if edit mode get the details
    this.getDetails();
  }

  categoryData: any;
  getDetails() {
    if (this.currentId) {
      this.eventService.getMemberDetails(this.currentId).subscribe(
        (response) => {
          const memberData = response.data;

          this.memberForm.patchValue({
            id_member: memberData.id_member,
            firstname: memberData.firstname,
            lastname: memberData.lastname,
            phone_number: memberData.phone_number,
            id_customer: memberData.id_customer,
          });
          this.imagePath = response.imagePath;
        },
        (error) => {},
      );
    }
  }

  onSubmit() {
    this.formSubmitted = true;
    if (this.memberForm.valid) {
      const formData = new FormData();
      formData.append('id_member', this.memberForm.value.id_member);
      formData.append('firstname', this.memberForm.value.firstname);
      formData.append('lastname', this.memberForm.value.lastname);
      formData.append('phone_number', this.memberForm.value.phone_number);
      formData.append('id_customer', this.memberForm.value.id_customer);

      if (this.currentId) {
        this.eventService.updateMember(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      } else {
        this.eventService.addMember(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      }
    }
  }

  navigateBack() {
    this.router.navigateByUrl('/members');
  }

  capitalizeFirstLetter(string: string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  delete() {
    Swal.fire({
      title: 'Are you sure?',
      text: 'Want to Delete Member',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete',
    }).then((result) => {
      if (result.isConfirmed) {
        this.eventService.deleteMember(this.currentId).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              // title: this.capitalizeFirstLetter(this.type),
              text: 'Member Deleted',
              showConfirmButton: false,
              timer: 1500,
            }).then((deleteResult) => {
              this.navigateBack();
            });
          },
          (error) => {
            Swal.fire({
              icon: 'error',
              text: 'Member Delete Failed!',
              showConfirmButton: false,
              timer: 1500,
            });
          },
        );
      }
    });
  }

  onOptionSelect(option: any) {
    this.memberForm.patchValue({
      name: option.expense_name,
      category: option.id_category,
    });

    this.expenseSuggestion = [];
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
