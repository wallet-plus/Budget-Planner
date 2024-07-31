import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  loginForm: FormGroup;
  
  returnUrl: string;

  constructor(private fb: FormBuilder, private route: ActivatedRoute, private router: Router) {
    this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/dashboard';

    this.loginForm = this.fb.group({
      emailOrPhone: ['', [
        Validators.required,
        Validators.pattern(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$|^[0-9]{10}$/) // Email or 10-digit phone
      ]],
      password: ['', [
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(15)
      ]],
      rememberMe: [false]
    });
  }



  login() {
    localStorage.setItem('userinfo', 'true');

    // Navigate to the returnUrl or default to the dashboard
    this.router.navigate([this.returnUrl]);
  }
}
