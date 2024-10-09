import { ChangeDetectorRef, Component, OnInit } from '@angular/core';
import { LoaderService } from './services/loader.service';
import { TranslationService } from './services/translation.service';
import { locale as enLang } from '../assets/i18n/en';
import { locale as hiLang } from '../assets/i18n/hi';
import { locale as teLang } from '../assets/i18n/te';
import { locale as taLang } from '../assets/i18n/ta';
import { locale as mrLang } from '../assets/i18n/mr';
import { locale as bnLang } from '../assets/i18n/bn';
import { locale as knLang } from '../assets/i18n/kn';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
})
export class AppComponent implements OnInit {
  title: string = 'walletplus';
  isLoading: any;
  constructor(
    private loaderService: LoaderService,
    private cdr: ChangeDetectorRef,
    private translationService: TranslationService,
  ) {
    this.translationService.loadTranslations(
      enLang,
      hiLang,
      teLang,
      taLang,
      mrLang,
      bnLang,
      knLang,
    );
  }

  ngOnInit(): void {
    if (localStorage.getItem('language')) {
      this.translationService.setLanguage(localStorage.getItem('language'));
    }

    this.loaderService.loaderState$.subscribe((state: boolean) => {
      this.isLoading = state;
      this.cdr.detectChanges();
    });
  }
}
