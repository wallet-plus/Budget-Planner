import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
// import { SwiperModule } from 'swiper/angular';
// import { ChartsModule } from 'ng2-charts';
// import { NgCircleProgressModule } from 'ng-circle-progress';
// import { NouisliderModule } from 'ng2-nouislider';
// import { FullCalendarModule } from '@fullcalendar/angular'; // must go before plugins
// import dayGridPlugin from '@fullcalendar/daygrid'; // a plugin!
// import { Daterangepicker } from 'ng2-daterangepicker';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
// import { ImageCropperModule } from 'ngx-image-cropper';
import { TranslateModule } from '@ngx-translate/core';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthlayoutComponent } from './authlayout/authlayout.component';
import { ApphomelayoutComponent } from './apphomelayout/apphomelayout.component';
import { AppinnerlayoutComponent } from './appinnerlayout/appinnerlayout.component';
import { SigninComponent } from './authlayout/signin/signin.component';
import { SignupComponent } from './authlayout/signup/signup.component';
import { ForgetpasswordComponent } from './authlayout/forgetpassword/forgetpassword.component';
import { ResetpasswordComponent } from './authlayout/resetpassword/resetpassword.component';
import { VerifyComponent } from './authlayout/verify/verify.component';
import { ThankyouComponent } from './authlayout/thankyou/thankyou.component';
import { StaticfooterComponent } from './apphomelayout/partials/staticfooter/staticfooter.component';
import { HeadermenuComponent } from './apphomelayout/partials/headermenu/headermenu.component';
import { SidebarComponent } from './apphomelayout/partials/sidebar/sidebar.component';
import { HomeComponent } from './apphomelayout/home/home.component';
import { StatsComponent } from './apphomelayout/stats/stats.component';
import { BarchartComponent } from './apphomelayout/stats/barchart/barchart.component';
import { ProfileComponent } from './appinnerlayout/profile/profile.component';
import { StyleComponent } from './appinnerlayout/style/style.component';
import { FooterinfoComponent } from './appinnerlayout/partials/footerinfo/footerinfo.component';
import { HeaderbackComponent } from './appinnerlayout/partials/headerback/headerback.component';
import { ChatlistComponent } from './appinnerlayout/chatlist/chatlist.component';
import { MessagesComponent } from './appinnerlayout/messages/messages.component';
import { NotificationsComponent } from './appinnerlayout/notifications/notifications.component';
import { PagesComponent } from './appinnerlayout/pages/pages.component';
import { FaqsComponent } from './appinnerlayout/faqs/faqs.component';
import { ContactusComponent } from './appinnerlayout/contactus/contactus.component';
import { TermsandcoditionComponent } from './appinnerlayout/termsandcodition/termsandcodition.component';
import { PagenotfoundComponent } from './appinnerlayout/pagenotfound/pagenotfound.component';
import { DoughnutChartComponent } from './apphomelayout/stats/doughnut-chart/doughnut-chart.component';
import { AboutusComponent } from './appinnerlayout/aboutus/aboutus.component';
import { ExpensesComponent } from './apphomelayout/expenses/expenses.component';
import { IncomeComponent } from './apphomelayout/income/income.component';
import { SavingsComponent } from './apphomelayout/savings/savings.component';
import { SharedModule } from './shared/shared.module';
import { CurrencyPipe } from './pipes/currency.pipe';
import { WalletInterceptor } from './services/wallet.interceptor';
import { TransactionComponent } from './appinnerlayout/transaction/transaction.component';
import { CardComponent } from './appinnerlayout/card/card.component';
import { CardsComponent } from './apphomelayout/cards/cards.component';
import { UsersComponent } from './apphomelayout/users/users.component';
import { UserDetailsComponent } from './appinnerlayout/user-details/user-details.component';
import { CategoriesComponent } from './apphomelayout/categories/categories.component';
import { ZakatCalulatorComponent } from './appinnerlayout/zakat-calculator/zakat-calculator.component';
import { AddCategoryComponent } from './appinnerlayout/add-category/add-category.component';
import { AddEventComponent } from './appinnerlayout/add-event/add-event.component';
import { EventsComponent } from './apphomelayout/events/events.component';
import { MembersComponent } from './apphomelayout/members/members.component';
import { AddMemberComponent } from './appinnerlayout/add-member/add-member.component';

// FullCalendarModule.registerPlugins([
//   // register FullCalendar plugins
//   dayGridPlugin,
// ]);

@NgModule({
  declarations: [
    AppComponent,
    AuthlayoutComponent,
    ApphomelayoutComponent,
    AppinnerlayoutComponent,
    SigninComponent,
    SignupComponent,
    ForgetpasswordComponent,
    ResetpasswordComponent,
    VerifyComponent,
    ThankyouComponent,
    StaticfooterComponent,
    HeadermenuComponent,
    SidebarComponent,
    HomeComponent,
    StatsComponent,
    BarchartComponent,
    ProfileComponent,
    StyleComponent,
    FooterinfoComponent,
    HeaderbackComponent,
    ChatlistComponent,
    MessagesComponent,
    NotificationsComponent,
    PagesComponent,
    FaqsComponent,
    ContactusComponent,
    TermsandcoditionComponent,
    PagenotfoundComponent,
    DoughnutChartComponent,
    AboutusComponent,
    ExpensesComponent,
    IncomeComponent,
    SavingsComponent,
    CurrencyPipe,
    TransactionComponent,
    CardComponent,
    CardsComponent,
    UsersComponent,
    UserDetailsComponent,
    CategoriesComponent,
    ZakatCalulatorComponent,
    AddCategoryComponent,
    AddEventComponent,
    EventsComponent,
    MembersComponent,
    AddMemberComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    // SwiperModule,
    // ChartsModule,
    // NgCircleProgressModule.forRoot(),
    // NouisliderModule,
    // FullCalendarModule,
    // Daterangepicker,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    SharedModule,
    // ImageCropperModule,
    // PdfViewerModule
    TranslateModule.forRoot(),
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: WalletInterceptor,
      multi: true,
    },
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
