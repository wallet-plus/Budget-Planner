import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-income',
  templateUrl: './income.component.html',
})
export class IncomeComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo: any;

  expenseList: any;
  imagePath: string = '';
  categoryImagePath: string = '';

  constructor(
    private router: Router,
    private bugetService: BudgetService,
    private localStorageService: LocalStorageService,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.bugetService.getList(3).subscribe(
        (response) => {
          this.imagePath = response.imagePath;
          this.categoryImagePath = response.categoryImagePath;
          this.expenseList = response.list;
        },
        (error) => {},
      );
    }
  }

  openTransaction(expense: any, type: string) {
    // const navigationExtras: NavigationExtras = {
    //   queryParams: {
    //     id: expense.id_expense
    //   },
    // };
    // this.router.navigate(['/add', type], navigationExtras);
    this.router.navigate(['/add', type, expense.id_expense]);
  }
}
