import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss'],
})
export class SidebarComponent implements OnInit {
  userInfo: any;
  constructor(
    private _authService: AuthService,
    private localStorageService: LocalStorageService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (!this.userInfo) {
      this.router.navigateByUrl('/signin');
    }
  }

  menuclose() {
    const body = document.getElementsByTagName('body')[0];
    body.classList.remove('menu-open');
  }

  logout() {
    this._authService.signOut().subscribe(
      (response) => {
        this.localStorageService.clear();
        this.menuclose();
        this.router.navigateByUrl('/signin');
      },
      (error) => {
        // Navigate to the confirmation required page
        // this._router.navigateByUrl('/confirmation-required');

        this.localStorageService.clear();
        this.menuclose();
        this.router.navigateByUrl('/signin');
      },
    );
  }
}
