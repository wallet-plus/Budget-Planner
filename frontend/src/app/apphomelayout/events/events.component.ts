import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-events',
  templateUrl: './events.component.html',
  styleUrls: ['./events.component.scss'],
})
export class EventsComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo: any;

  events: any;
  imagePath: string = '';
  categoryImagePath: string = '';

  constructor(
    private router: Router,
    private eventService: EventService,
    private localStorageService: LocalStorageService,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.eventService.events().subscribe(
        (response) => {
          this.events = response;
        },
        (error) => {},
      );
    }
  }

  openEvent(event: any) {
    this.router.navigate(['/add-event', event.id_event]);
  }
}
