import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent {

  registerForm: FormGroup;

  constructor(private fb: FormBuilder){
    this.registerForm = this.fb.group({
      username: ['', [
        Validators.required,
        Validators.minLength(3),
        Validators.maxLength(20),
        Validators.pattern(/^[a-zA-Z0-9_]+$/)
      ]],
      email: ['', [
        Validators.required,
        Validators.email
      ]],
      phone: ['', [
        Validators.required,
        Validators.pattern(/^[0-9]{10}$/)
      ]],
      password: ['', [
        Validators.required,
        Validators.minLength(8),
        Validators.maxLength(20)
      ]],
      terms: [false, Validators.requiredTrue]
    });
  }

  register() {
    if (this.registerForm.valid) {
      // Implement registration logic
      console.log(this.registerForm.value);
    } else {
      this.focusInvalidField();
    }
  }

  focusInvalidField() {
    for (const key of Object.keys(this.registerForm.controls)) {
      if (this.registerForm.controls[key].invalid) {
        const invalidControl = this.registerForm.controls[key];
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
