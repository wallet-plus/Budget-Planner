import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-staticfooter',
  templateUrl: './staticfooter.component.html',
  styleUrls: ['./staticfooter.component.scss'],
})
export class StaticfooterComponent {
  public isVisited = false;
  constructor(private router: Router) {}

  checkVisited() {
    this.isVisited = !this.isVisited;
  }

  LogTransaction(path: string) {
    this.router
      .navigateByUrl('/RefreshComponent', { skipLocationChange: true })
      .then(() => {
        this.router.navigate([path]);
      });
  }
}
