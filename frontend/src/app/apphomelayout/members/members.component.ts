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

  queryParam : string = '';
  sortOrder: 'asc' | 'desc' = 'asc';
  
  userInfo: any;
  memberList: any;
  imagePath: string = '';

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
          this.memberList = response.list;
        },
        (error) => {},
      );
    }
  }

  toggleSortOrder() {
    this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
  }

  openMember(member: any) {
    this.router.navigate(['/add-member', member.id_member]);
  }

  clearQuery() {
    this.queryParam = '';  // Clear the search parameter
  }
  
}
