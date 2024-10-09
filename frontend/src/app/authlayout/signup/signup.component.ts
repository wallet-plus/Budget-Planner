import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss'],
})
export class SignupComponent implements OnInit {
  registrationForm: FormGroup;
  showPassword: boolean = false;
  constructor(
    private fb: FormBuilder,
    private _authService: AuthService,
    private router: Router,
  ) {
    this.registrationForm = this.fb.group({
      name: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(5)]],
      phone: ['', [Validators.required, Validators.pattern(/^[0-9]+$/)]],
    });
  }

  onSubmit() {
    if (this.registrationForm.valid) {
      this._authService.signUp(this.registrationForm.value).subscribe(
        (response) => {
          this.router.navigateByUrl('/signin');
        },
        (error) => {
          if (error.error.key) {
            const controlName = error.error.key;
            this.registrationForm
              .get(controlName)
              ?.setErrors({ invalid: true });

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
      const firstInvalidControl = Object.keys(
        this.registrationForm.controls,
      ).find((controlName) => this.registrationForm.get(controlName)?.invalid);
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

  ngOnInit(): void {
    const tooltiptriggerList = [].slice.call(
      document.querySelectorAll('[data-bs-toggle="tooltip"]'),
    );
    tooltiptriggerList.map((e) => {
      return new bootstrap.Tooltip(e);
    });
  }

  validateNumber(event: Event) {
    const inputElement = event.target as HTMLInputElement;
    const inputValue = inputElement.value;
    const numericValue = inputValue.replace(/[^0-9]/g, '');
    inputElement.value = numericValue;
    const phoneControl = this.registrationForm.get('phone');
    if (phoneControl) {
      phoneControl.setValue(numericValue);
    }
  }
}
