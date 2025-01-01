import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BudgetComponent } from './budget.component';
import { SharedModule } from '../shared/shared.module';
import { RouterModule, Routes } from '@angular/router';
import { ExpensesComponent } from './components/expenses/expenses.component';
import { IncomeComponent } from './components/income/income.component';
import { SavingsComponent } from './components/savings/savings.component';
import { CategoriesComponent } from './components/categories/categories.component';
import { TranslateModule } from '@ngx-translate/core';
import { FormsModule } from '@angular/forms';
import { MaterialModule } from '../material.module';

const routes: Routes = [
  {
    path: '',
    component: BudgetComponent,

    children: [
      {
        path: 'expenses',
        component: ExpensesComponent,
      },
      {
        path: 'income',
        component: IncomeComponent,
      },
      {
        path: 'savings',
        component: SavingsComponent,
      },
      {
        path: 'categories',
        component: CategoriesComponent,
      }
      
    ],
  },
];

@NgModule({
  declarations: [
    BudgetComponent,
    ExpensesComponent,
    IncomeComponent,
    SavingsComponent,
    CategoriesComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    RouterModule.forChild(routes),
    TranslateModule.forChild(),
    FormsModule,
    MaterialModule
  ]
})
export class BudgetModule { }
