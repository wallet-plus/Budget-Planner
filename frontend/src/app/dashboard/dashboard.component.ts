import { Component, OnInit } from '@angular/core';
import { PersonalFinanceService } from '../services/personal-finance.service';
import { StatisticsRequest, StatisticsResponse, TransactionRequest, TransactionResponse } from '../services/personal-finance.model';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit{

  statisticsRequest: StatisticsRequest = {"startDate":"2024-08-01","endDate":"2024-08-31"};
  dashboardData: StatisticsResponse | undefined;
  balanceAmount : number = 0;
  constructor(private personalFinanceService : PersonalFinanceService){}
  
  ngOnInit(): void {
    this.getTransactions();
  }

  getTransactions(): void {
    this.personalFinanceService.statistics(this.statisticsRequest).subscribe(
      (response: StatisticsResponse) => {
        this.dashboardData = response;

        const incomeTotal = parseFloat(this.dashboardData.incomeTotal) || 0;
        const expenditureTotal = parseFloat(this.dashboardData.expenditureTotal) || 0;
        const expenseTotal = parseFloat(this.dashboardData.expenseTotal) || 0;
  
        this.balanceAmount = incomeTotal - expenditureTotal - expenseTotal;

        // this.transactionList = [...this.transactionList, ...this.statisticsResponse?.list || []];
        //   this.hasMore = this.statisticsResponse?.list.length === this.limit;
        console.log(this.dashboardData);
      },
      (error) => {
        console.error('Error fetching transactions', error);
      }
    );
  }
}
