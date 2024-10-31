import {
  ChangeDetectorRef,
  Component,
  Input,
  OnChanges,
  SimpleChanges,
} from '@angular/core';
// import { ChartDataSets, ChartType, ChartOptions } from 'chart.js';
// import { Label, Colors } from 'ng2-charts';

@Component({
  selector: 'app-barchart',
  templateUrl: './barchart.component.html',
  styleUrls: ['./barchart.component.scss'],
})
export class BarchartComponent implements OnChanges {
  @Input() expenseData: any;
  // areaChartOptions: ChartOptions = {
  //   responsive: true,
  //   scales: {
  //     yAxes: [
  //       {
  //         display: false,
  //       },
  //     ],
  //     xAxes: [
  //       {
  //         gridLines: {
  //           display: false,
  //         },
  //         ticks: {
  //           fontColor: '#999999',
  //         },
  //       },
  //     ],
  //   },
  // };
  // areaChartLabels: Label[] = [];
  // areaChartType: ChartType = 'line';
  // areaChartLegend = false;
  // areaChartPlugins = [];
  // areaChartColors: Colors[] = [
  //   {
  //     // yellow
  //     backgroundColor: 'rgba(255, 28, 82, 0.5)',
  //     borderColor: '#FF1C52',
  //     pointBackgroundColor: '#ffffff',
  //     pointBorderColor: '#FF1C52',
  //     pointHoverBackgroundColor: '#FF1C52',
  //     pointHoverBorderColor: 'rgba(148,159,177,0.8)',
  //     borderWidth: 1,
  //   },
  // ];
  // areaChartData: ChartDataSets[] = [{ data: [], label: 'Quarterly Result' }];

  constructor(private cdr: ChangeDetectorRef) {}

  ngOnChanges(changes: SimpleChanges): void {
    // if (changes.expenseData && changes.expenseData.currentValue) {
    //   const chartData: any = [];
    //   const chartLabels: Label[] = [];

    //   changes.expenseData.currentValue.forEach((category: any) => {
    //     chartLabels.push(category.date_of_transaction);
    //     chartData.push(category.amount);
    //   });

    //   this.areaChartLabels = chartLabels;
    //   this.areaChartData = [{ data: chartData, label: 'My Expenses' }];

    //   this.cdr.detectChanges();
    // }
  }
}
