import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { LoaderService } from 'src/app/services/loader.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.scss'],
})
export class SigninComponent implements OnInit {
  showPassword: boolean = false;

  loginForm: FormGroup = this.fb.group({
    phone: ['', [Validators.required, Validators.pattern(/^[0-9]{10}$/)]],
    password: ['', [Validators.required, Validators.minLength(5)]],
  });

  constructor(
    private fb: FormBuilder,
    private _authService: AuthService,
    private router: Router,
    private localStorageService: LocalStorageService,
    private loaderService: LoaderService,
  ) {}

  ngOnInit(): void {
    // check if user loggedIn
    const userInfo = this.localStorageService.getItem('userInfo');
    if (userInfo) {
      this.router.navigateByUrl('/home');
    }

    const tooltiptriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]'),
    );
    tooltiptriggerList.map((e) => {
      return new bootstrap.Tooltip(e);
    });
  }

  onSubmit() {
    if (this.loginForm.valid) {
      this._authService.signIn(this.loginForm.value).subscribe(
        (response) => {
          this.localStorageService.setItem('accessToken', response.accessToken);
          this.localStorageService.setItem('userInfo', response);

          this.loaderService.hide();
          this.router.navigateByUrl('/home');
        },
        (error) => {
          if (error.error.key) {
            const controlName = error.error.key;
            this.loginForm.get(controlName)?.setErrors({ invalid: true });
            const element = document.querySelector(
              `[formControlName="${controlName}"]`,
            ) as HTMLElement | null;
            if (element) {
              element.focus();
            }
          }
        },
      );
    } else {
      const firstInvalidControl = Object.keys(this.loginForm.controls).find(
        (controlName) => this.loginForm.get(controlName)?.invalid,
      );
      if (firstInvalidControl) {
        const element = document.querySelector(
          `[formControlName="${firstInvalidControl}"]`,
        ) as HTMLElement | null;
        if (element) {
          element.focus();
        }
      }
    }
  }
}
