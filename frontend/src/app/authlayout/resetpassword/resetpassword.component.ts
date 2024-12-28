import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-resetpassword',
  templateUrl: './resetpassword.component.html',
  styleUrls: ['./resetpassword.component.scss'],
})
export class ResetpasswordComponent implements OnInit {
  showPassword: boolean = false;

  resetPasswordForm: FormGroup = this.fb.group(
    {
      email: [
        '',
        [
          Validators.required,
          Validators.pattern(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/),
        ],
      ],
      code: ['', [Validators.required]],
      password: ['', [Validators.required, Validators.minLength(5)]],
      confirmPassword: ['', [Validators.required, Validators.minLength(5)]],
    },
    {
      validators: this.passwordsMatchValidator, // Add the custom validator
    }
  );

  constructor(
    private _authService: AuthService,
    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.activatedRoute.queryParams.subscribe((params: Params) => {
      this.resetPasswordForm.patchValue({
        email: params['email'],
        code: params['code'],
      });
    });
  }

  passwordsMatchValidator(form: FormGroup) {
    const password = form.get('password')?.value;
    const confirmPassword = form.get('confirmPassword')?.value;
    return password === confirmPassword ? null : { passwordsMismatch: true };
  }

  onSubmit() {
    if (this.resetPasswordForm.valid) {
      this._authService.resetPassword(this.resetPasswordForm.value).subscribe(
        (response) => {
          this.router.navigateByUrl('/thankyou');
        },
        (error) => {
          if (error.error.key) {
            const controlName = error.error.key;
            this.resetPasswordForm
              .get(controlName)
              ?.setErrors({ invalid: true });
            const element = document.querySelector(
              `[formControlName="${controlName}"]`
            ) as HTMLElement | null;
            if (element) {
              element.focus();
            }
          }
        }
      );
    } else {
      const firstInvalidControl = Object.keys(
        this.resetPasswordForm.controls
      ).find((controlName) => this.resetPasswordForm.get(controlName)?.invalid);
      if (firstInvalidControl) {
        const element = document.querySelector(
          `[formControlName="${firstInvalidControl}"]`
        ) as HTMLElement | null;
        if (element) {
          element.focus();
        }
      }
    }
  }
}
