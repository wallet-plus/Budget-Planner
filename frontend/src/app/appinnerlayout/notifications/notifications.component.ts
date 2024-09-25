import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-notifications',
  templateUrl: './notifications.component.html',
  styleUrls: ['./notifications.component.scss'],
})
export class NotificationsComponent implements OnInit {
  ngOnInit(): void {
    const footerhide: any = document.getElementsByTagName('app-footerinfo')[0];
    footerhide.remove();
  }
}
