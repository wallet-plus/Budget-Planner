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
    return this._httpClient.post(`${environment.apiUrl}http-card/cards`, null);
  }

  getDetails(cardId: number): Observable<any> {
    const formData = new FormData();
    formData.append('id', cardId.toString());
    return this._httpClient.post(
      `${environment.apiUrl}http-card/get`,
      formData,
    );
  }

  addCard(cardData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-card/add-card`,
      cardData,
    );
  }

  updateCard(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-card/update-card`,
      expenseData,
    );
  }

  deleteCard(cardId: number): Observable<any> {
    const formData = new FormData();
    formData.append('id', cardId.toString());
    return this._httpClient.post(
      `${environment.apiUrl}http-card/delete`,
      formData,
    );
  }
}
