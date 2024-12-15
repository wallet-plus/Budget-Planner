import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { CategoryService } from 'src/app/services/category.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-add-category',
  templateUrl: './add-category.component.html',
  styleUrls: ['./add-category.component.scss'],
})
export class AddCategoryComponent implements OnInit {
  typeList: any;
  userInfo: any;
  categoryList: any;
  categoryImagePath!: string;
  categoryForm!: FormGroup;
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
    private categoryService: CategoryService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.currentId = parseInt(params['id_category']);
    });

    this.categoryForm = this.formBuilder.group({
      id_category: [''],
      id_type: ['2'],
      id_user: [''],
      parent: [''],
      category_name: ['', Validators.required],
      category_description: [''],
      category_image: [null],
      status: ['1', Validators.required],
    });

    this.userInfo = this.localStorageService.getItem('userInfo');
    this.categoryForm.patchValue({ id: this.userInfo.id });
    this.getCategories();
    // if edit mode get the details
    this.getDetails();
  }

  getCategories() {
    this.categoryService.categoryList('0').subscribe(
      (response) => {
        this.categoryImagePath = response.categoryImagePath;
        this.categoryList = response.list;
      },
      (error) => {},
    );
  }

  categoryData: any;
  getDetails() {
    if (this.currentId) {
      this.categoryService.getCategoryDetails(this.currentId).subscribe(
        (response) => {
          const categoryData = (this.categoryData = response.data);
          this.categoryForm.patchValue({
            id_category: categoryData.id_category,
            id_type: categoryData.id_type,
            id_user: categoryData.id_user,
            parent: categoryData.parent,
            category_name: categoryData.category_name,
            category_description: categoryData.category_description,
            category_image: categoryData.category_image, // or handle image file differently if necessary
            status: categoryData.status,
          });
          this.imagePath = response.imagePath;
        },
        (error) => {},
      );
    }
  }

  onSubmit() {
    this.formSubmitted = true;
    if (this.categoryForm.valid) {
      const formData = new FormData();
      formData.append('id_category', this.categoryForm.value.id_category);
      formData.append('id_type', this.categoryForm.value.id_type);
      formData.append('id_user', this.categoryForm.value.id_user);
      formData.append('parent', this.categoryForm.value.parent);
      formData.append('category_name', this.categoryForm.value.category_name);
      formData.append(
        'category_description',
        this.categoryForm.value.category_description || '',
      );
      formData.append('status', this.categoryForm.value.status);

      if (this.selectedImage) {
        formData.append('category_image', this.selectedImage);
      } else {
        formData.append(
          'category_image',
          this.categoryForm.value.category_image || '',
        );
      }

      if (this.currentId) {
        this.categoryService.updateCategory(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      } else {
        this.categoryService.addCategory(formData).subscribe(
          (response) => {
            this.navigateBack();
          },
          (error) => {},
        );
      }
    }
  }

  navigateBack() {
    this.router.navigateByUrl('/categories');
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
      text: 'Want to Delete Category',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete',
    }).then((result) => {
      if (result.isConfirmed) {
        this.categoryService.deleteCategory(this.currentId).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              text: 'Category Deleted',
              showConfirmButton: false,
              timer: 1500,
            }).then((deleteResult) => {
              this.navigateBack();
            });
          },
          (error) => {
            Swal.fire({
              icon: 'error',
              text: 'Transaction Delete Failed!',
              showConfirmButton: false,
              timer: 1500,
            });
          },
        );
      }
    });
  }

  // getSuggestions(param: any) {
  //   this.bugetService.getSuggestion(param.value).subscribe(
  //     (response) => {
  //       this.expenseSuggestion = response;
  //       // this.categoryList = response;
  //     },
  //     (error) => {},
  //   );
  // }

  onOptionSelect(option: any) {
    this.categoryForm.patchValue({
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
