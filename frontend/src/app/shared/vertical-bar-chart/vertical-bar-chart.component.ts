import { ChangeDetectorRef, Component, Input, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import * as Highcharts from 'highcharts';

@Component({
  selector: 'app-vertical-bar-chart',
  templateUrl: './vertical-bar-chart.component.html',
  styleUrls: ['./vertical-bar-chart.component.scss']
})
export class VerticalBarChartComponent implements OnInit, OnChanges {
  @Input() expenseData: any;
  Highcharts: typeof Highcharts = Highcharts;
  chartOptions: Highcharts.Options = {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Expenses'
    },
    xAxis: {
      categories: [],  // This will be populated dynamically
      title: {
        text: 'Date of Transaction'
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Amount (Rs.)'
      }
    },
    series: [
      {
        name: 'Transactions',
        type: 'column',
        data: []  // This will be populated dynamically
      }
    ]
  };

  constructor(private cd: ChangeDetectorRef) {}

  ngOnInit(): void {
    this.updateChartData();
  }

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['expenseData']) {
      this.updateChartData();
    }
  }

  private updateChartData(): void {
    if (this.expenseData && Array.isArray(this.expenseData) && this.expenseData.length > 0) {
      const amounts = this.expenseData.map((expense: any) => parseFloat(expense.amount) || 0);
      const dates = this.expenseData.map((expense: any) => expense.date_of_transaction || '');

      // Use type assertion for xAxis and series
      this.chartOptions.xAxis = {
        categories: dates,
        title: {
          text: 'Date of Transaction'
        }
      } as Highcharts.XAxisOptions;

      this.chartOptions.series = [{
        name: 'Transactions',
        type: 'column',
        data: amounts
      }] as Highcharts.SeriesOptionsType[];

      this.cd.detectChanges();
    } else {
      this.chartOptions.xAxis = {
        categories: [],
        title: {
          text: 'Date of Transaction'
        }
      } as Highcharts.XAxisOptions;

      this.chartOptions.series = [{
        name: 'Transactions',
        type: 'column',
        data: []
      }] as Highcharts.SeriesOptionsType[];

      this.cd.detectChanges();
    }
  }
}
