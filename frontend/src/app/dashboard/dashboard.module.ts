import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DashboardComponent } from './dashboard.component';
import { StaticfooterComponent } from '../shared/staticfooter/staticfooter.component';
import { AppModule } from '../app.module';
import { TranslateModule } from '@ngx-translate/core';
import { RouterModule, Routes } from '@angular/router';
import { SharedModule } from '../shared/shared.module';
import { HighchartsChartModule } from 'highcharts-angular';
import { NgxDaterangepickerBootstrapModule } from 'ngx-daterangepicker-bootstrap';
import { FormsModule } from '@angular/forms';

const dashboardRoutes: Routes = [
  { path: '', component: DashboardComponent }
];

@NgModule({
  declarations: [
    DashboardComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    RouterModule.forChild(dashboardRoutes),
    TranslateModule.forChild(),
    NgxDaterangepickerBootstrapModule,
    FormsModule
  ]
})
export class DashboardModule { }
