import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ExpensesComponent } from './expenses/expenses.component';
import { IncomeComponent } from './income/income.component';
import { SavingsComponent } from './savings/savings.component';
import { PersonalFinanceComponent } from './personal-finance.component';
import { RouterModule, Routes } from '@angular/router';
import { AddTransactionComponent } from './add-transaction/add-transaction.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

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
        path : 'add',
        component : AddTransactionComponent
      }
    ]
  }
];

@NgModule({
  declarations: [
    ExpensesComponent,
    IncomeComponent,
    SavingsComponent,
    PersonalFinanceComponent,
    AddTransactionComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    ReactiveFormsModule
  ]
})
export class PersonalFinanceModule { }
