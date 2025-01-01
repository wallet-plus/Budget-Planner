import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CategoryService {
  constructor(private _httpClient: HttpClient) {}

  getBudgetAllocations( year : number): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/get-budget-allocations`,
      {year},
    );
  }
  

  saveBudgetAllocations(budgetAllocations: any[]): Observable<any> {
    
    return this._httpClient.post(
      `${environment.apiUrl}http-category/budget-allocations`, budgetAllocations
    );
  }

  categoryTypes(): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/category-types`,{}
    );
  }

  categoryList(type: string): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/category-list`,
      {
        type,
      },
    );
  }

  getCategoryDetails(id: number): Observable<any> {
    const request = { id };
    return this._httpClient.post(
      `${environment.apiUrl}http-category/category-details`,
      request,
    );
  }

  addCategory(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/category`,
      expenseData,
    );
  }

  updateCategory(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/category`,
      expenseData,
    );
  }

  deleteCategory(id: number): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-category/delete-category`,
      {
        id,
      },
    );
  }
}
