import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
  pageTitle : string = 'Walletplus';

  constructor(private title: Title){}

  ngOnInit() : void{
    this.title.setTitle(this.pageTitle);
  }

  
}
