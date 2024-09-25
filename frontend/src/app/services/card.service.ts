import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CardService {
  constructor(private _httpClient: HttpClient) {}

  getSuggestion(param: string): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}card/suggestion`, {
      param,
    });
  }

  categoryList(type: string): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}card/category-list`, {
      type,
    });
  }

  getList(): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}card/get-list`, null);
  }

  getDetails(cardId: number): Observable<any> {
    return this._httpClient.get(`${environment.apiUrl}card/get/${cardId}`);
  }

  addCard(expenseData: any): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}card/add`, expenseData);
  }

  deleteCard(id: number): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}card/delete/`, { id });
  }

  updateCard(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}card/update`,
      expenseData,
    );
  }
}
