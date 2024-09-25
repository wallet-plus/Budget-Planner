import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CategoryService {
  constructor(private _httpClient: HttpClient) {}

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
