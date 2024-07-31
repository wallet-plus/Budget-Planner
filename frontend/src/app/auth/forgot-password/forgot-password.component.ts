import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.scss']
})
export class ForgotPasswordComponent {

  forgotPasswordForm: FormGroup;

  constructor(private fb: FormBuilder) {
    this.forgotPasswordForm = this.fb.group({
      email: ['', [
        Validators.required,
        Validators.email
      ]]
    });
  }

  sendResetLink() {
    if (this.forgotPasswordForm.valid) {
      // Implement the logic to send the reset link
      console.log(this.forgotPasswordForm.value);
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
