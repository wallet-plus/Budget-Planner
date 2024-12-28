import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { LoaderComponent } from './loader/loader.component';
import { StaticfooterComponent } from './staticfooter/staticfooter.component';
import { HeadermenuComponent } from './headermenu/headermenu.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { TranslateModule } from '@ngx-translate/core';
import { VerticalBarChartComponent } from './vertical-bar-chart/vertical-bar-chart.component';
import { PieChartComponent } from './pie-chart/pie-chart.component';
import { HighchartsChartModule } from 'highcharts-angular';
import { CurrencyPipe } from './pipes/currency.pipe';

@NgModule({
  declarations: [LoaderComponent,
    StaticfooterComponent,
    HeadermenuComponent,
    SidebarComponent,
    VerticalBarChartComponent,
    PieChartComponent,
    CurrencyPipe
  ],
  imports: [CommonModule, RouterModule,
    TranslateModule.forChild(),
    HighchartsChartModule
  ],
  exports: [LoaderComponent,
    StaticfooterComponent,
    HeadermenuComponent,
    SidebarComponent,
    VerticalBarChartComponent,
    PieChartComponent,
    CurrencyPipe
  ],

})
export class SharedModule { }
