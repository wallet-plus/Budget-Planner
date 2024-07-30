import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  returnUrl: string;

  constructor(private route: ActivatedRoute, private router: Router) {
    // Capture the returnUrl from the route parameters or default to '/'
    this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/dashboard';
  }

  login() {
    debugger;
    // Assume the login process is successful and set user info in local storage
    localStorage.setItem('userinfo', 'true');

    // Navigate to the returnUrl or default to the dashboard
    this.router.navigate([this.returnUrl]);
  }
}
