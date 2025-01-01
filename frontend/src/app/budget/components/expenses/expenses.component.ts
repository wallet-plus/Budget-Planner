import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { CategoryService } from 'src/app/services/category.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-expenses',
  templateUrl: './expenses.component.html',
})
export class ExpensesComponent implements OnInit {
  userInfo: any;
  expenseList: any;
  imagePath: string = '';
  categoryImagePath: string = '';
  queryParam: string = '';
  category!: number;
  categoryList: any;

  startDate: any;
  endDate: any;
  totalExpense: number = 0;
  constructor(
    private router: Router,
    private bugetService: BudgetService,
    private categoryService: CategoryService,
    private localStorageService: LocalStorageService,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.getRecords();
      this.getCategories();
    }
  }

  resetTotalExpense() {
    this.expenseList = [];
    this.totalExpense = 0;
  }

  getRecords() {
    this.resetTotalExpense();
    this.bugetService
      .getList(2, this.queryParam, this.category, this.startDate, this.endDate)
      .subscribe(
        (response) => {
          this.imagePath = response.imagePath;
          this.categoryImagePath = response.categoryImagePath;
          this.expenseList = response.list;
          if (this.expenseList) {
            this.expenseList.forEach((expense: any) => {
              this.totalExpense += parseFloat(expense.amount);
            });
          }
        },
        (error) => {},
      );
  }

  openTransaction(expense: any, type: string) {
    // const navigationExtras: NavigationExtras = {
    //   queryParams: {
    //     id_expense: expense.id_expense
    //   },
    // };
    // navigationExtras
    this.router.navigate(['/add', type, expense.id_expense]);
  }

  getCategories() {
    this.categoryService.categoryList('expense').subscribe(
      (response) => {
        this.categoryList = response.list;
      },
      (error) => {},
    );
  }
}
