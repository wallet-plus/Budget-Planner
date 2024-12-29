import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CategoryService } from 'src/app/services/category.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html',
  styleUrls: ['./categories.component.scss'],
})
export class CategoriesComponent implements OnInit {
  conversionPrice: number = 1;
  userInfo: any;

  categoryList: any;
  imagePath: string = '';
  categoryImagePath: string = '';

  constructor(
    private router: Router,
    private categoryService: CategoryService,
    private localStorageService: LocalStorageService,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.categoryService.categoryList('0').subscribe(
        (response) => {
          // this.imagePath = response.imagePath;
          this.categoryImagePath = response.categoryImagePath;
          this.categoryList = response.list;
        },
        (error) => {},
      );
    }
  }

  openCategory(category: any) {
    this.router.navigate(['/add-category', category.id_category]);
  }
}
