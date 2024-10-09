import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { EventService } from 'src/app/services/event.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-members',
  templateUrl: './members.component.html',
  styleUrls: ['./members.component.scss'],
})
export class MembersComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo: any;

  memberList: any;
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
      this.eventService.getMembers().subscribe(
        (response) => {
          this.imagePath = response.imagePath;
          this.categoryImagePath = response.categoryImagePath;
          this.memberList = response.list;
        },
        (error) => {},
      );
    }
  }

  openMember(member: any) {
    this.router.navigate(['/add-member', member.id_member]);
  }
}
