import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environement/environment';
import { CategoryListRequest, CategoryListResponse, StatisticsRequest, StatisticsResponse, TransactionRequest, TransactionResponse } from './personal-finance.model';

@Injectable({
  providedIn: 'root'
})
export class PersonalFinanceService {

  constructor(private http: HttpClient) {}
  
  getTransactions(transactionRequest: TransactionRequest): Observable<TransactionResponse> {
    return this.http.post<TransactionResponse>(`${environment.apiURL}/budget/get-list`, transactionRequest);
  }

  // {"startDate":"2024-08-01","endDate":"2024-08-31"}
  statistics(statisticsRequest: StatisticsRequest): Observable<StatisticsResponse> {
    return this.http.post<StatisticsResponse>(`${environment.apiURL}/budget/statistics`, statisticsRequest);
  }

  getCategoryList(request: CategoryListRequest): Observable<CategoryListResponse> {
    return this.http.post<CategoryListResponse>(`${environment.apiURL}/budget/category-list`, request);
  }
  add(budget: TransactionRequest): Observable<TransactionResponse> {
    return this.http.post<TransactionResponse>(`${environment.apiURL}/budget/add`, budget);
  }
}
