import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

// import SwiperCore, {
//   Navigation,
//   Pagination,
//   Scrollbar,
//   A11y,
// } from 'swiper/core';

// SwiperCore.use([Navigation, Pagination, Scrollbar, A11y]);

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
})
export class HomeComponent implements OnInit {
  userImagePath!: string;
  expenseImagePath!: string;
  categoryImagePath!: string;
  userInfo: any;

  expenseList: any;
  isChecked: boolean = false;

  greeting: string = '';

  constructor(
    private router: Router,
    private bugetService: BudgetService,
    private localStorageService: LocalStorageService,
  ) {}
  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.bugetService.getList(0).subscribe(
        (response) => {
          this.userImagePath = response.userImagePath;
          this.categoryImagePath = response.categoryImagePath;
          this.expenseImagePath = response.expenseImagePath;
          this.expenseList = response.list;
        },
        (error) => {},
      );
    }
    const currentHour = new Date().getHours();
    switch (true) {
      case currentHour >= 5 && currentHour < 12:
        this.greeting = 'Good Morning';
        break;
      case currentHour >= 12 && currentHour < 18:
        this.greeting = 'Good Afternoon';
        break;
      case currentHour >= 18 && currentHour < 22:
        this.greeting = 'Good Evening';
        break;
      default:
        this.greeting = 'Good Night';
    }
  }

  doCheck() {
    const html = document.getElementsByTagName('html')[0];
    this.isChecked = !this.isChecked;
    if (this.isChecked === true) {
      html.classList.add('dark-mode');
    } else {
      html.classList.remove('dark-mode');
    }
  }
}
