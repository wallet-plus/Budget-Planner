import { Injectable } from '@angular/core';
import { CanActivate, Router, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { Observable, of } from 'rxjs';
import { tap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(private router: Router) { }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean> | boolean {
    const userInfo = localStorage.getItem('userinfo');
    
    if (userInfo) {
      return true;
    } else {
      // User is not logged in, redirect to the login page
      this.router.navigate(['/auth/login'], { queryParams: { returnUrl: state.url } });
      return false;
    }
  }
}
