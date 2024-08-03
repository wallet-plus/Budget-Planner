import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environement/environment';
import { TransactionRequest, TransactionResponse } from './personal-finance.model';

@Injectable({
  providedIn: 'root'
})
export class PersonalFinanceService {

  constructor(private http: HttpClient) {}
  
  getTransactions(transactionRequest: TransactionRequest): Observable<TransactionResponse> {
    return this.http.post<TransactionResponse>(`${environment.apiURL}/budget/get-list`, transactionRequest);
  }

  // {"startDate":"2024-08-01","endDate":"2024-08-31"}
  statistics(transactionRequest: TransactionRequest): Observable<TransactionResponse> {
    return this.http.post<TransactionResponse>(`${environment.apiURL}/budget/statistics`, transactionRequest);
  }

}
