import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ExpensesComponent } from './expenses/expenses.component';
import { IncomeComponent } from './income/income.component';
import { SavingsComponent } from './savings/savings.component';
import { PersonalFinanceComponent } from './personal-finance.component';
import { RouterModule, Routes } from '@angular/router';
import { InfiniteScrollModule } from 'ngx-infinite-scroll';

const routes: Routes = [
  {
    path: '',
    component: PersonalFinanceComponent,
    children: [
      {
        path: '',
        redirectTo: 'expenses',
        pathMatch: 'full'
      },
      {
        path: 'expenses',
        component: ExpensesComponent
      },
      {
        path: 'savings',
        component: SavingsComponent
      },
      {
        path: 'income',
        component: IncomeComponent
      }
    ]
  }
];

@NgModule({
  declarations: [
    ExpensesComponent,
    IncomeComponent,
    SavingsComponent,
    PersonalFinanceComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    InfiniteScrollModule
  ]
})
export class PersonalFinanceModule { }
