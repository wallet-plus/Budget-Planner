import { Injectable } from '@angular/core';
import {
  HttpEvent,
  HttpInterceptor,
  HttpHandler,
  HttpRequest,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { catchError, finalize } from 'rxjs/operators';
import { Router } from '@angular/router';
import Swal from 'sweetalert2';
import { LoaderService } from './loader.service'; // Adjust the path
import { LocalStorageService } from './local-storage.service';

@Injectable()
export class WalletInterceptor implements HttpInterceptor {
  private closeDialog$ = new Observable<void>();
  constructor(
    private loaderService: LoaderService,
    private localStorageService: LocalStorageService,
    private router: Router,
  ) {}

  intercept(
    request: HttpRequest<any>,
    next: HttpHandler,
  ): Observable<HttpEvent<any>> {
    this.loaderService.show(); // Show the spinner

    const accessToken = this.localStorageService.getItem('accessToken');
    const authRequest = request.clone({
      setHeaders: {
        Authorization: `Bearer ${accessToken}`,
      },
    });

    return next.handle(authRequest).pipe(
      catchError((error) => {
        if (!navigator.onLine) {
          this.showNetworkIssueDialog();
        }

        if (error.status === 401) {
          this.localStorageService.clear();
          this.router.navigateByUrl('/signin');
        }
        throw error; // Re-throw the error for further handling
      }),

      finalize(() => {
        this.loaderService.hide(); // Hide the spinner after API call is complete
      }),
    );
  }

  private showNetworkIssueDialog() {
    Swal.fire({
      icon: 'warning',
      title: 'Network Issue',
      text: 'Please check your internet connection.',
      allowOutsideClick: false,
      showConfirmButton: false,
    });

    this.closeDialog$ = new Observable<void>((observer) => {
      const intervalId = setInterval(() => {
        if (navigator.onLine) {
          clearInterval(intervalId);
          observer.next();
          observer.complete();
        }
      }, 3000);
    });

    this.closeDialog$.subscribe(() => {
      Swal.close();
    });
  }
}
