import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-messages',
  templateUrl: './messages.component.html',
})
export class MessagesComponent implements OnInit {
  ngOnInit(): void {
    const footerhide: any = document.getElementsByTagName('app-footerinfo')[0];
    footerhide.remove();
  }
}
