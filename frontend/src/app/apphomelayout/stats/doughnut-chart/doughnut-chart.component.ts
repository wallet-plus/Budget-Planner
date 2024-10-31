import { Component, Input, OnInit } from '@angular/core';
// import { ChartDataSets, ChartType, ChartOptions } from 'chart.js';
// import { Label, Colors } from 'ng2-charts';

@Component({
  selector: 'app-doughnut-chart',
  templateUrl: './doughnut-chart.component.html',
  styleUrls: ['./doughnut-chart.component.scss'],
})
export class DoughnutChartComponent implements OnInit {
  @Input() categories: any;
  // doughnutChartOptions: ChartOptions = {
  //   responsive: true,
  //   maintainAspectRatio: false,
  //   plugins: {
  //     legend: false,
  //     title: false,
  //   },
  // };
  // doughnutChartLabels: Label[] = [];
  // doughnutChartType: ChartType = 'doughnut';
  // doughnutChartLegend = false;
  // doughnutChartPlugins = [];
  // doughnutChartColors: Colors[] = [
  //   // { // yellow
  //   //   backgroundColor: ['#FFBD17', '#3AC79B', '#F73563', '#092C9F'],
  //   //   borderWidth: 0,
  //   // },
  // ];
  // doughnutChartData: ChartDataSets[] = [
  //   // { data: [55, 25, 10, 10], label: 'My Expenses' }
  // ];

  ngOnInit(): void {
    if (this.categories) {
      const chartData: any = [];
      // this.categories.forEach((category: any) => {
      //   this.doughnutChartLabels.push(category.category_name);
      //   chartData.push(category.total);
      // });
      // this.doughnutChartData.push({ data: chartData, label: 'My Expenses' });
    }
  }
}
