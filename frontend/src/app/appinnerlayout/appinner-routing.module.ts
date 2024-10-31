import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TranslateModule } from '@ngx-translate/core';
import { AppinnerlayoutComponent } from './appinnerlayout.component';
import { PagesComponent } from './pages/pages.component';
import { NotificationsComponent } from './notifications/notifications.component';
import { MessagesComponent } from './messages/messages.component';
import { ChatlistComponent } from './chatlist/chatlist.component';
import { PagenotfoundComponent } from './pagenotfound/pagenotfound.component';
import { FaqsComponent } from './faqs/faqs.component';
import { ContactusComponent } from './contactus/contactus.component';
import { TermsandcoditionComponent } from './termsandcodition/termsandcodition.component';
import { AboutusComponent } from './aboutus/aboutus.component';
import { TransactionComponent } from './transaction/transaction.component';
import { ProfileComponent } from './profile/profile.component';
import { CardComponent } from './card/card.component';
import { UserDetailsComponent } from './user-details/user-details.component';
import { ZakatCalulatorComponent } from './zakat-calculator/zakat-calculator.component';
import { AddCategoryComponent } from './add-category/add-category.component';
import { AddEventComponent } from './add-event/add-event.component';
import { AddMemberComponent } from './add-member/add-member.component';

const routes: Routes = [
  {
    path: '',
    component: AppinnerlayoutComponent,

    children: [
      {
        path: 'aboutus',
        component: AboutusComponent,
      },
      {
        path: 'chat',
        component: ChatlistComponent,
      },
      {
        path: 'messages',
        component: MessagesComponent,
      },
      {
        path: 'notifications',
        component: NotificationsComponent,
      },
      {
        path: 'profile',
        component: ProfileComponent,
      },
      {
        path: 'add/:type',
        component: TransactionComponent,
      },
      {
        path: 'add/:type/:id_expense',
        component: TransactionComponent,
      },
      {
        path: 'add-category',
        component: AddCategoryComponent,
      },
      {
        path: 'add-category/:id_category',
        component: AddCategoryComponent,
      },
      {
        path: 'add-event',
        component: AddEventComponent,
      },
      {
        path: 'add-event/:id_event',
        component: AddEventComponent,
      },
      {
        path: 'user',
        component: UserDetailsComponent,
      },
      {
        path: 'zakat-calculator',
        component: ZakatCalulatorComponent,
      },

      {
        path: 'user/:id_user',
        component: UserDetailsComponent,
      },
      {
        path: 'card',
        component: CardComponent,
      },
      {
        path: 'card/:id_card',
        component: CardComponent,
      },
      {
        path: 'pages',
        component: PagesComponent,
      },
      {
        path: 'pagenotfound',
        component: PagenotfoundComponent,
      },
      {
        path: 'faqs',
        component: FaqsComponent,
      },
      {
        path: 'contactus',
        component: ContactusComponent,
      },
      {
        path: 'termsandconditions',
        component: TermsandcoditionComponent,
      },

      {
        path: 'add-member/:id_member',
        component: AddMemberComponent,
      },
      {
        path: 'add-member',
        component: AddMemberComponent,
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes), TranslateModule.forChild()],
  exports: [RouterModule],
})
export class AppinnerlayoutRoutingModule {}
