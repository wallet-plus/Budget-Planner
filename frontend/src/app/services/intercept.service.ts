import { Injectable } from '@angular/core';
import { HttpEvent, HttpInterceptor, HttpHandler, HttpRequest, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
// import { debug } from 'util';


@Injectable()
export class InterceptService implements HttpInterceptor {
	// intercept request and add token
	intercept(
		request: HttpRequest<any>,
		next: HttpHandler
	): Observable<HttpEvent<any>> {

		const accessToken = localStorage.getItem('accessToken');
		if (accessToken) {
			request = request.clone({
			  setHeaders: {
				Authorization: `Bearer ${accessToken}`
			  }
			});
		  }

		return next.handle(request).pipe(
			tap(
				event => {
					 if (event instanceof HttpResponse) {
						// console.log('all looks good');
						// http response status code
						// console.log(event.status);
					}
				},
				error => {
					// http response status code
					// console.log('----response----');
					// console.error('status code:');
					// tslint:disable-next-line:no-debugger
					// console.error(error.status);
					// console.error(error.message);
					// console.log('--- end of response---');
				}
			)
		);
	}
}
