import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { ForgotPasswordComponent } from './forgot-password/forgot-password.component';
import { ResetPasswordComponent } from './reset-password/reset-password.component';
import { AuthComponent } from './auth.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path : '',
    component: AuthComponent,
    children: [
    {
      path:'',
      redirectTo : 'login',
      pathMatch : 'full'
    },
    {
      path :'login',
      component : LoginComponent
    },
    {
      path :'register',
      component : RegisterComponent
    },
    {
      path :'forgot-password',
      component : ForgotPasswordComponent
    },
    {
      path :'reset-password',
      component : ResetPasswordComponent
    }
    ]
  }
];


@NgModule({
  declarations: [
    LoginComponent,
    RegisterComponent,
    ForgotPasswordComponent,
    ResetPasswordComponent,
    AuthComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class AuthModule { }
