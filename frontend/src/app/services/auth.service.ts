import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environement/environment';
import { ForgotPasswordRequest, RegisterRequest } from './auth.model';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) {}
  
  login(email: string, password: string): Observable<any> {
    const loginPayload = { email, password };
    return this.http.post<any>(`${environment.apiURL}/auth/login`, loginPayload);
  }

  register(registerRequest: RegisterRequest): Observable<any> {
    return this.http.post<any>(`${environment.apiURL}/auth/register`, registerRequest);
  }

  forgotPassword(forgotPasswordRequest: ForgotPasswordRequest): Observable<any> {
    return this.http.post<any>(`${environment.apiURL}/auth/forgot-password`, forgotPasswordRequest);
  }

  
}
