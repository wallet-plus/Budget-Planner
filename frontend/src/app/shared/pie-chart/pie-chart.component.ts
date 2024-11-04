import { ChangeDetectorRef, Component, Input, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import * as Highcharts from 'highcharts';

@Component({
  selector: 'app-pie-chart',
  templateUrl: './pie-chart.component.html',
  styleUrls: ['./pie-chart.component.scss']
})
export class PieChartComponent implements OnInit, OnChanges {
  @Input() chartData: any; // Input for chart data
  Highcharts: typeof Highcharts = Highcharts; // Reference to Highcharts
  chartOptions: Highcharts.Options = {
    chart: {
      type: 'pie'
    },
    title: {
      text: 'Categories'
    },
    plotOptions: {
      pie: {
        innerSize: '50%', // This creates the donut effect
        dataLabels: {
          enabled: true,
          format: '{point.name}: {point.percentage:.1f} %' // Format for data labels
        }
      }
    },
    series: [{
      name: 'Data',
      type: 'pie',
      data: [] // Will be populated dynamically
    }]
  };

  constructor(private cd: ChangeDetectorRef) {}

  ngOnInit(): void {
    this.updateChart(); // Initialize chart data on component load
  }

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['chartData'] && !changes['chartData'].firstChange) {
      this.updateChart(); // Update chart data when input changes
    }
  }

  updateChart(): void {
    if (this.chartData && this.chartData.length > 0) {
      // Update series data based on the provided chartData
      this.chartOptions.series = [{
        name: 'Data',
        type: 'pie',
        data: this.chartData.map((data: any) => ({
          name: data.category_name, // Use the category name from your API response
          y: parseFloat(data.total) // Convert total to a number
        }))
      }];
      this.cd.detectChanges(); // Trigger change detection to update the chart
    }
  }
}
