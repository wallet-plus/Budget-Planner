import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { LoginRequest } from 'src/app/services/auth.model';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  loginForm: FormGroup;
  returnUrl: string;

  constructor(
    private fb: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private authService: AuthService
  ) {
    // Initialize returnUrl from query parameters or default to '/dashboard'
    this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/dashboard';

    this.loginForm = this.fb.group({
      email: ['', [
        Validators.required,
        Validators.email
      ]],
      password: ['', [
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(15)
      ]],
      rememberMe: [false]
    });
  }

  ngOnInit(): void {

    const rememberMe = localStorage.getItem('rememberMe') === 'true';
    if (rememberMe) {
      const email = localStorage.getItem('email');
      const password = localStorage.getItem('password');
      this.loginForm.patchValue({
        email: email,
        password: password,
        rememberMe: true
      });
    }

  }
  private loadRememberedCredentials(): void {
    const email = localStorage.getItem('email');
    const password = localStorage.getItem('password');
    if (email && password) {
      this.loginForm.patchValue({
        email: email,
        password: password,
        rememberMe: true
      });
    }
  }

  login() {
    if (this.loginForm.valid) {

      const rememberMe = this.loginForm.get('rememberMe')?.value;
      if (rememberMe) {

        const email = this.loginForm.get('email')?.value;
        const password = this.loginForm.get('password')?.value;
        localStorage.setItem('email', email);
        localStorage.setItem('password', password);
        localStorage.setItem('rememberMe', 'true');

      } else {
        localStorage.removeItem('email');
        localStorage.removeItem('password');
        localStorage.removeItem('rememberMe');
      }

      const loginRequest: LoginRequest = {
        email: this.loginForm.controls['email'].value, // Correct form control name
        password: this.loginForm.controls['password'].value
      };

      this.authService.login(loginRequest.email, loginRequest.password).subscribe(response => {
        // Handle successful login

        localStorage.setItem('accessToken', response.accessToken);

        // Save the user object in local storage
        localStorage.setItem('g', JSON.stringify({
          id: response.id,
          email: response.email,
          phone: response.phone,
          name: response.name,
          image: response.image,
          imagePath: response.imagePath,
          status: response.status
        }));

        // Navigate to the returnUrl or default to the dashboard
        this.router.navigate([this.returnUrl]);
      }, error => {
        // Handle login error
        console.error('Login failed', error);
      });
    } else {
      this.focusInvalidField();
    }
  }

  focusInvalidField() {
    for (const key of Object.keys(this.loginForm.controls)) {
      if (this.loginForm.controls[key].invalid) {
        const invalidControl = this.loginForm.controls[key];
        invalidControl.markAsTouched();  // Ensure error messages are shown
        const controlElement = document.getElementById(key);
        if (controlElement) {
          controlElement.focus();
        }
        break;
      }
    }
  }
}
