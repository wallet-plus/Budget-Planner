import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { EmployeeManagementComponent } from './employee-management.component';
import { DirectoryComponent } from './directory/directory.component';
import { OnboardingComponent } from './onboarding/onboarding.component';
import { AttendanceComponent } from './attendance/attendance.component';
import { PayrollComponent } from './payroll/payroll.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path : '',
    component: EmployeeManagementComponent,
    children: [
    // {
      // path:'',
      // redirectTo : 'directory'
    // },
    {
      path :'directory',
      component : DirectoryComponent
    },
    {
      path :'onboarding',
      component : OnboardingComponent
    },
    {
      path :'Attendance',
      component : AttendanceComponent
    },
    {
      path :'Payroll',
      component : PayrollComponent
    }
    ]
  }
];


@NgModule({
  declarations: [
    EmployeeManagementComponent,
    DirectoryComponent,
    OnboardingComponent,
    AttendanceComponent,
    PayrollComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes)
  ]
})
export class EmployeeManagementModule { }
