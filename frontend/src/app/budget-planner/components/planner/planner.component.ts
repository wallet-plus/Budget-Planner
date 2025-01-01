import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { CategoryService } from 'src/app/services/category.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import Swal from 'sweetalert2';
import * as moment from 'moment';

@Component({
  selector: 'app-planner',
  templateUrl: './planner.component.html',
  styleUrls: ['./planner.component.scss'],
})
export class PlannerComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo: any;

  categoryList: any;
  imagePath: string = '';
  categoryImagePath: string = '';
  categoryTypesList: any = [];
  categoryForm!: FormGroup;

  currentYear: number = moment().year();
  yearList: number[] = [];

  constructor(
    private router: Router,
    private categoryService: CategoryService,
    private localStorageService: LocalStorageService,
    private fb: FormBuilder
  ) {}

  
  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      
      this.getCategoryTypes();
      this.generateYearList();
      this.getBudgetAllocations();
    }
  }

  generateYearList(): void {
    const startYear = 2023;
    const endYear = 2027;
    for (let year = startYear; year <= endYear; year++) {
      this.yearList.push(year);
    }
  }

  getCategoryTypes() {
    this.categoryService.categoryTypes().subscribe(
      (response) => {
        this.categoryImagePath = response.categoryImagePath;
        this.categoryTypesList = response.list;
      },
      (error) => {
        console.error('Error fetching category types', error);
      }
    );
  }

  getBudgetAllocations() {
    this.categoryService.getBudgetAllocations(this.currentYear).subscribe(
      (response) => {
        this.categoryList = response.allocations;
        if (this.categoryList) {
          const formControls: { [key: string]: any } = {};
          this.categoryList.forEach((category: any, index: number) => {
            formControls[`amount_${category.id_category}`] = [
              category.amount,
              [Validators.min(1), Validators.max(1000000)],
            ];
          });
          this.categoryForm = this.fb.group(formControls);
        }
      },
      (error) => {
        console.error('Error fetching category list', error);
      }
    );
  }

  openCategory(category: any) {
    this.router.navigate(['/add-category', category.id_category]);
  }

  onSubmit(): void {
    if (this.categoryForm.valid) {
      const budgetAllocations = this.categoryList.reduce((result: any[], category: any) => {
        const amount = this.categoryForm.get(`amount_${category.id_category}`)?.value;

        if (amount !== undefined && amount !== null && amount > 0) {
          result.push({
            category_id: category.id_category,
            category_name: category.category_name,
            amount: amount,
            year: this.currentYear, // Include the current year
          });
        }

        return result;
      }, []);

      if (budgetAllocations.length > 0) {
        this.categoryService.saveBudgetAllocations(budgetAllocations).subscribe(
          (response: any) => {
            Swal.fire({
              title: 'Success!',
              text: 'Budget allocations have been saved successfully.',
              icon: 'success',
              confirmButtonText: 'OK',
            });
          },
          (error: any) => {
            Swal.fire({
              title: 'Error!',
              text: 'Failed to save budget allocations. Please try again later.',
              icon: 'error',
              confirmButtonText: 'Retry',
            });
          }
        );
      }
    }
  }
}
