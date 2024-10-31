import { ChangeDetectorRef, Component, OnInit } from '@angular/core';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import * as moment from 'moment';

@Component({
  selector: 'app-stats',
  templateUrl: './stats.component.html',
  styleUrls: ['./stats.component.scss'],
})
export class StatsComponent implements OnInit {
  categoryImagePath!: string;
  statisticsData: any;
  userInfo: any;
  public daterange: any = {};
  expenseData: any;
  public options: any = {
    locale: { format: 'DD-MM-YYYY', direction: 'daterange-center shadow' },
    alwaysShowCalendars: false,
  };

  startDate: any;
  endDate: any;

  public selectedDate(value: any, datepicker?: any) {
    datepicker.start = value.start;
    datepicker.end = value.end;

    this.daterange.start = value.start;
    this.daterange.end = value.end;
    this.daterange.label = value.label;

    this.startDate = moment(value.start).format('YYYY-MM-DD');
    this.endDate = moment(value.end).format('YYYY-MM-DD');
    this.searchRecords();
  }

  constructor(
    private bugetService: BudgetService,
    private localStorageService: LocalStorageService,
    private cdr: ChangeDetectorRef,
  ) {}

  ngOnInit(): void {
    const today = moment();

    const startOfMonth = today.clone().startOf('month');
    const endOfMonth = today.clone().endOf('month');

    this.startDate = startOfMonth.format('YYYY-MM-DD');
    this.endDate = endOfMonth.format('YYYY-MM-DD');

    this.options.startDate = startOfMonth.format('DD-MM-YYYY');
    this.options.endDate = endOfMonth.format('DD-MM-YYYY');
    this.userInfo = this.localStorageService.getItem('userInfo');
    this.searchRecords();
  }

  searchRecords() {
    if (this.userInfo) {
      const request = {
        startDate: this.startDate,
        endDate: this.endDate,
      };
      this.expenseData = [];
      this.bugetService.statistics(request).subscribe(
        (response) => {
          this.categoryImagePath = response.categoryImagePath;

          this.statisticsData = response;

          this.statisticsData.balance =
            parseFloat(this.statisticsData?.incomeTotal) -
            (parseFloat(this.statisticsData?.expenseTotal) +
              parseFloat(this.statisticsData?.expenditureTotal));

          this.expenseData = response.expenseData;
          this.cdr.detectChanges();
        },
        (error) => {},
      );
    }
  }
}
