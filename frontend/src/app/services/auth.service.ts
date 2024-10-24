import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of, throwError } from 'rxjs';
import { switchMap } from 'rxjs/operators';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private _authenticated: boolean = false;

  /**
   * Constructor
   */
  constructor(
    private _httpClient: HttpClient,
    // private _userService: UserService
  ) {}

  // -----------------------------------------------------------------------------------------------------
  // @ Accessors
  // -----------------------------------------------------------------------------------------------------

  /**
   * Setter & getter for access token
   */
  set accessToken(token: string) {
    localStorage.setItem('accessToken', token);
  }

  get accessToken(): string {
    return localStorage.getItem('accessToken') ?? '';
  }

  // -----------------------------------------------------------------------------------------------------
  // @ Public methods
  // -----------------------------------------------------------------------------------------------------

  /**
   * Forgot password
   *
   * @param email
   */
  forgotPassword(email: string): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}auth/forgot-password`, {
      email,
    });
  }

  /**
   * Reset password
   *
   * @param password
   */
  resetPassword(resetModel: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}/auth/reset-password`,
      resetModel,
    );
  }

  /**
   * Sign in
   *
   * @param credentials
   */
  signIn(credentials: { email: string; password: string }): Observable<any> {
    // Throw error, if the user is already logged in
    if (this._authenticated) {
      return throwError('User is already logged in.');
    }

    return this._httpClient
      .post(`${environment.apiUrl}auth/login`, credentials)
      .pipe(
        switchMap((response: any) => {
          this.accessToken = response.accessToken;
          this._authenticated = true;
          return of(response);
        }),
      );
  }

  /**
   * Sign out
   *
   * @param user
   */
  signOut(): Observable<any> {
    this._authenticated = false;
    return this._httpClient.get(`${environment.apiUrl}auth/logout`);
  }

  /**
   * Sign up
   *
   * @param user
   */
  signUp(user: {
    name: string;
    email: string;
    password: string;
    phone: string;
  }): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}auth/register`, user);
  }

  /**
   * Unlock session
   *
   * @param credentials
   */
  // unlockSession(credentials: { email: string; password: string }): Observable<any>
  // {
  //     return this._httpClient.post('api/auth/unlock-session', credentials);
  // }

  /**
   * Check the authentication status
   */
  // check(): Observable<boolean>
  // {
  //     // Check if the user is logged in
  //     if ( this._authenticated )
  //     {
  //         return of(true);
  //     }

  //     // Check the access token availability
  //     if ( !this.accessToken )
  //     {
  //         return of(false);
  //     }

  //     // // Check the access token expire date
  //     // if ( AuthUtils.isTokenExpired(this.accessToken) )
  //     // {
  //     //     return of(false);
  //     // }

  //     // If the access token exists and it didn't expire, sign in using it
  //     return this.signInUsingToken();
  // }

  /**
   * Sign out
   *
   * @param user
   */
  getProfile(requestData: any): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}auth/profile`,
      requestData,
    );
  }

  saveProfile(profileData: FormData): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}auth/save-profile`,
      profileData,
    );
  }

  getUsers(): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}auth/users`, null);
  }

  getUserDetails(id: number): Observable<any> {
    return this._httpClient.post(`${environment.apiUrl}auth/user-details`, {
      id,
    });
  }

  createUser(profileData: FormData): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}auth/create-user`,
      profileData,
    );
  }

  updateUser(profileData: FormData): Observable<any> {
    return this._httpClient.post(
      `${environment.apiUrl}auth/update-user`,
      profileData,
    );
  }


  // deleteUser(profileData: FormData): Observable<any> {
  //   return this._httpClient.post(
  //     `${environment.apiUrl}auth/delete-user`,
  //     profileData,
  //   );
  // }

  deleteUser(cardId: number): Observable<any> {
    const formData = new FormData();
    formData.append('id', cardId.toString());
    return this._httpClient.post(
      `${environment.apiUrl}auth/delete-user`,
      formData,
    );
  }
}
