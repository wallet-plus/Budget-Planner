import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { RegisterRequest } from 'src/app/services/auth.model';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent {

  registerForm: FormGroup;

  constructor(private fb: FormBuilder, private authService: AuthService, private router: Router){
    this.registerForm = this.fb.group({
      name: ['', [
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
      const registerRequest: RegisterRequest = {
        name: this.registerForm.controls['name'].value,
        email: this.registerForm.controls['email'].value,
        phone: this.registerForm.controls['phone'].value,
        password: this.registerForm.controls['password'].value,
        terms: this.registerForm.controls['terms'].value
      };

      this.authService.register(registerRequest).subscribe(response => {
        // Handle successful registration
        console.log('Registration successful', response);
        this.router.navigate(['/auth/login']);
      }, error => {
        // Handle registration error
        console.error('Registration failed', error);
      });
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
