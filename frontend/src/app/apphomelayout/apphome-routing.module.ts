import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TranslateModule } from '@ngx-translate/core';
import { HomeComponent } from './home/home.component';
import { StatsComponent } from './stats/stats.component';
import { ApphomelayoutComponent } from './apphomelayout.component';
import { StyleComponent } from '../appinnerlayout/style/style.component';
import { ExpensesComponent } from './expenses/expenses.component';
import { IncomeComponent } from './income/income.component';
import { SavingsComponent } from './savings/savings.component';
import { SharedModule } from '../shared/shared.module';
import { CardsComponent } from './cards/cards.component';
import { UsersComponent } from './users/users.component';
import { CategoriesComponent } from './categories/categories.component';
import { EventsComponent } from './events/events.component';
import { MembersComponent } from './members/members.component';

const routes: Routes = [
  {
    path: '',
    component: ApphomelayoutComponent,

    children: [
      {
        path: 'home',
        component: HomeComponent,
      },
      {
        path: 'stats',
        component: StatsComponent,
      },
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
        path: 'cards',
        component: CardsComponent,
      },

      {
        path: 'users',
        component: UsersComponent,
      },
      {
        path: 'categories',
        component: CategoriesComponent,
      },
      {
        path: 'events',
        component: EventsComponent,
      },
      {
        path: 'style',
        component: StyleComponent,
      },
      {
        path: 'members',
        component: MembersComponent,
      },
    ],
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes),
    SharedModule,
    TranslateModule.forChild(),
  ],
  exports: [RouterModule],
})
export class ApphomelayoutRoutingModule {}
