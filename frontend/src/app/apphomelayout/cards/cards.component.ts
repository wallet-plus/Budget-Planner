import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CardService } from 'src/app/services/card.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';

@Component({
  selector: 'app-cards',
  templateUrl: './cards.component.html',
})
export class CardsComponent implements OnInit {
  userInfo: any;
  cardsList: any;
  imagePath: string = '';
  categoryImagePath: string = '';

  constructor(
    private router: Router,
    private cardService: CardService,
    private localStorageService: LocalStorageService,
  ) {}

  ngOnInit(): void {
    this.userInfo = this.localStorageService.getItem('userInfo');
    if (this.userInfo) {
      this.cardService.getList().subscribe(
        (response) => {
          this.imagePath = response.cardsImagePath;
          this.cardsList = response.list;
        },
        (error) => {},
      );
    }
  }

  openCards(card: any) {
    this.router.navigate(['/card', card.id_card]);
  }
}
