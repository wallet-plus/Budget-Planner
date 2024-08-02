import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ErrorResponse, ForgotPasswordRequest } from 'src/app/services/auth.model';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.scss']
})
export class ForgotPasswordComponent {

  forgotPasswordForm: FormGroup;
  serverError: string | null = null;  

  constructor(private fb: FormBuilder, private authService: AuthService) {
    this.forgotPasswordForm = this.fb.group({
      email: ['', [
        Validators.required,
        Validators.email
      ]]
    });
  }

  sendResetLink() {
    if (this.forgotPasswordForm.valid) {
      const forgotPasswordRequest: ForgotPasswordRequest = {
        email: this.forgotPasswordForm.controls['email'].value
      };

      this.authService.forgotPassword(forgotPasswordRequest).subscribe(response => {
        // Handle successful response
        console.log('Reset link sent successfully', response);
      }, (error ) => {
        debugger;
        this.serverError = error.error.error || 'An error occurred. Please try again later.';
      });
    } else {
      this.focusInvalidField();
    }
  }
  focusInvalidField() {
    for (const key of Object.keys(this.forgotPasswordForm.controls)) {
      if (this.forgotPasswordForm.controls[key].invalid) {
        const control = this.forgotPasswordForm.controls[key];
        control.markAsTouched();
        const controlElement = document.getElementById(key);
        if (controlElement) {
          controlElement.focus();
        }
        break;
      }
    }
  }
}
