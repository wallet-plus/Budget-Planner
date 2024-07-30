import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthComponent } from './auth/auth.component';
import { BaseComponent } from './theme/base/base.component';
import { AuthGuard } from './services/auth.guard';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'auth',
    pathMatch: 'full'
  },
  {
    path: '',
    component: AuthComponent,
    children: [
      {
        path: 'auth',
        loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule)
      }
    ]
  },
  {
    path: '',
    component: BaseComponent,
    canActivate: [AuthGuard],
    children: [
      {
        path: 'personal-finance',
        loadChildren: () => import('./personal-finance/personal-finance.module').then(m => m.PersonalFinanceModule)
      },
      {
        path: 'dashboard',
        loadChildren: () => import('./dashboard/dashboard.module').then(m => m.DashboardModule)
      },
      {
        path :'employee',
        loadChildren: () => import('./employee-management/employee-management.module').then((m) => m.EmployeeManagementModule)
      }
    ]
  },
  {
    path: '**',
    redirectTo: '/login'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
