import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-forgetpassword',
  templateUrl: './forgetpassword.component.html',
  styleUrls: ['./forgetpassword.component.scss'],
})
export class ForgetpasswordComponent {
  forgotPasswordForm: FormGroup = this.fb.group({
    email: [
      '',
      [
        Validators.required,
        Validators.pattern(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/),
      ],
    ],
  });

  constructor(
    private _authService: AuthService,
    private fb: FormBuilder,
    private router: Router,
  ) {}

  onSubmit() {
    if (this.forgotPasswordForm.valid) {
      this._authService
        .forgotPassword(this.forgotPasswordForm.controls['email'].value)
        .subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              text: response.message,
              showConfirmButton: false,
              timer: 1500,
            });
          },
          // (error) => {
          //   Swal.fire({
          //     icon: 'error',
          //     text: 'Transaction Delete Failed!',
          //     showConfirmButton: false,
          //     timer: 1500,
          //   });
          // },
        );
      // localStorage.setItem("token","login");
      // this.router.navigateByUrl('auth/reset-password/token');
      // Handle form submission
    }
  }
}
