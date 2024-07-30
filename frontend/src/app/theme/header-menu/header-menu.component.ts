import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header-menu',
  templateUrl: './header-menu.component.html',
  styleUrls: ['./header-menu.component.scss']
})
export class HeaderMenuComponent {
  constructor(private router: Router) { }
  
  logout(){
    localStorage.clear();
    this.router.navigate(['/auth/login']);
  }
}
