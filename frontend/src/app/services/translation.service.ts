// Angular
import { Injectable } from '@angular/core';
// Tranlsation
import { TranslateService } from '@ngx-translate/core';
import { Subject } from 'rxjs';
import { LocalStorageService } from './local-storage.service';

export interface Locale {
  lang: string;
  // tslint:disable-next-line:ban-types
  data: Object;
}

@Injectable({
  providedIn: 'root',
})
export class TranslationService {
  public currentLanguage: string = 'en';
  // Private properties
  private langIds: any = [];
  private detectLanguageChange = new Subject<boolean>();
  /**
   * Service Constructor
   *
   * @param translate: TranslateService
   */
  constructor(
    private translate: TranslateService,
    public localStorage: LocalStorageService,
  ) {
    // add new langIds to the list
    this.translate.addLangs(['en']);

    // this language will be used as a fallback when a translation isn't found in the current language
    this.translate.setDefaultLang('en');
  }

  /**
   * Load Translation
   *
   * @param args: Locale[]
   */
  loadTranslations(...args: Locale[]): void {
    const locales = [...args];
    locales.forEach((locale) => {
      // use setTranslation() with the third argument set to true
      // to append translations instead of replacing them
      this.translate.setTranslation(locale.lang, locale.data, true);

      this.langIds.push(locale.lang);
    });
    // add new languages to the list
    this.translate.addLangs(this.langIds);
  }

  /**
   * Setup language
   *
   * @param lang: any
   */
  setLanguage(lang: any) {
    if (lang) {
      this.translate.use(this.translate.getDefaultLang());
      this.translate.use(lang);
      localStorage.setItem('language', lang);
      this.currentLanguage = lang;

      if (lang === 'en') this.detectLanguageChange.next(false);
      else this.detectLanguageChange.next(true);
    }
  }

  /**
   * Returns selected language
   */
  getSelectedLanguage(): any {
    return localStorage.getItem('language') || this.translate.getDefaultLang();
  }

  detectChange() {
    return this.detectLanguageChange.asObservable();
  }
}
