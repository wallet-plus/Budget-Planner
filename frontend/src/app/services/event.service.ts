import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class EventService {
  constructor(private _httpClient: HttpClient) {}

  events(): Observable<any> {
    return this._httpClient.get(`${environment.apiUrl}http-event/events`);
  }

  addEvent(eventData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/event`,
      eventData,
    );
  }

  updateEvent(eventData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/event`,
      eventData,
    );
  }

  getEventDetails(request: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/event-details`,
      request,
    );
  }
  eventExpenses(request: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/expense-member-total`,
      request,
    );
  }

  deleteEvent(id: number): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/delete-event/`,
      {
        id,
      },
    );
  }

  getMembers(): Observable<any> {
    return this._httpClient.get(`${environment.apiUrl}http-event/members-list`);
  }

  addMember(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/member`,
      expenseData,
    );
  }

  updateMember(expenseData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/member`,
      expenseData,
    );
  }

  deleteMember(id: number): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}http-event/delete-member`,
      {
        id,
      },
    );
  }

  getMemberDetails(id: number): Observable<any> {
    const request = { id };
    return this._httpClient.post(
      `${environment.apiUrl}http-event/member-details`,
      request,
    );
  }
}
