import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TranslateModule } from '@ngx-translate/core';
import { HomeComponent } from './home/home.component';
import { ApphomelayoutComponent } from './apphomelayout.component';
import { StyleComponent } from '../appinnerlayout/style/style.component';
import { SharedModule } from '../shared/shared.module';
import { CardsComponent } from './cards/cards.component';
import { UsersComponent } from './users/users.component';
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
        path: 'cards',
        component: CardsComponent,
      },

      {
        path: 'users',
        component: UsersComponent,
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
