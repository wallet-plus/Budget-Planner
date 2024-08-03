import { Component, OnInit } from '@angular/core';
import { TransactionRequest, TransactionResponse } from 'src/app/services/personal-finance.model';
import { PersonalFinanceService } from 'src/app/services/personal-finance.service';

@Component({
  selector: 'app-expenses',
  templateUrl: './expenses.component.html',
  styleUrls: ['./expenses.component.scss']
})
export class ExpensesComponent implements OnInit {

  transactionRequest: TransactionRequest = { type: 0 };
  transactionResponse: TransactionResponse | undefined;
  
  transactionList: any[] = [];
  page: number = 1;
  limit: number = 10;
  hasMore: boolean = true;

  constructor(private personalFinanceService : PersonalFinanceService){}


  ngOnInit(): void {
   
    this.getTransactions();

  
  }

  getTransactions(): void {
    this.personalFinanceService.getTransactions(this.transactionRequest).subscribe(
      (response: TransactionResponse) => {
        this.transactionResponse = response;
        this.transactionList = [...this.transactionList, ...this.transactionResponse?.list || []];
          this.hasMore = this.transactionResponse?.list.length === this.limit;
        console.log(this.transactionResponse);
      },
      (error) => {
        console.error('Error fetching transactions', error);
      }
    );
  }
  
  loadData(): void {
    if (this.hasMore) {
      this.page++;
      this.getTransactions();
    }
  }


}
