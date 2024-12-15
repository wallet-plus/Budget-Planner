import { ChangeDetectorRef, Component, OnInit, AfterViewInit, HostListener, Renderer2, ElementRef } from '@angular/core';
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
export class AppComponent implements OnInit, AfterViewInit {
  title: string = 'walletplus';
  isLoading: any;

  constructor(
    private loaderService: LoaderService,
    private cdr: ChangeDetectorRef,
    private translationService: TranslationService,
    private renderer: Renderer2,
    private el: ElementRef
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
    // Set language from localStorage if available
    if (localStorage.getItem('language')) {
      this.translationService.setLanguage(localStorage.getItem('language'));
    }

    // Listen for loading state changes
    this.loaderService.loaderState$.subscribe((state: boolean) => {
      this.isLoading = state;
      this.cdr.detectChanges();
    });

    // Check if page is loaded in an iframe
    const body = this.el.nativeElement.querySelector('body');
    if (window.self !== window.top) {
      this.renderer.addClass(body, 'iframe');
    } else {
      this.renderer.removeClass(body, 'iframe');
    }

    // Menu style switch - 'menu-pushcontent' checkbox
    const menuPushContentCheckbox = this.el.nativeElement.querySelector('#menu-pushcontent');
    if (menuPushContentCheckbox) {
      this.renderer.listen(menuPushContentCheckbox, 'change', () => {
        if (menuPushContentCheckbox.checked) {
          this.renderer.addClass(body, 'menu-push-content');
          this.renderer.removeClass(body, 'menu-overlay');
        }
      });
    }

    // Menu style switch - 'menu-overlay' checkbox
    const menuOverlayCheckbox = this.el.nativeElement.querySelector('#menu-overlay');
    if (menuOverlayCheckbox) {
      this.renderer.listen(menuOverlayCheckbox, 'change', () => {
        if (menuOverlayCheckbox.checked) {
          this.renderer.removeClass(body, 'menu-push-content');
          this.renderer.addClass(body, 'menu-overlay');
        }
      });
    }

    // Back button functionality
    const backButton = this.el.nativeElement.querySelector('.back-btn');
    if (backButton) {
      this.renderer.listen(backButton, 'click', (event) => {
        event.preventDefault();
        window.history.back();
      });
    }

    // Center button click toggle
    const centerButton = this.el.nativeElement.querySelector('.centerbutton .nav-link');
    if (centerButton) {
      this.renderer.listen(centerButton, 'click', () => {
        if (centerButton.classList.contains('active')) {
          this.renderer.removeClass(centerButton, 'active');
        } else {
          this.renderer.addClass(centerButton, 'active');
        }
      });
    }

    // URL path highlighting in the menu
    const path = window.location.href;
    const menuLinks = this.el.nativeElement.querySelectorAll('.main-menu ul a');
    menuLinks.forEach((link: HTMLAnchorElement) => {
      if (link.href === path) {
        menuLinks.forEach((link : any) => this.renderer.removeClass(link, 'active'));
        this.renderer.addClass(link, 'active');
      }
    });
  }

  ngAfterViewInit(): void {
    // Setting main container min-height
    const main = this.el.nativeElement.querySelector('main');
    if (main) {
      const windowHeight = window.innerHeight;
      this.renderer.setStyle(main, 'min-height', `${windowHeight}px`);

      // Padding adjustments based on header and footer heights
      const header = this.el.nativeElement.querySelector('.header.position-fixed');
      const footer = this.el.nativeElement.querySelector('.footer');
      if (header) {
        const headerHeight = header.offsetHeight;
        this.renderer.setStyle(main, 'padding-top', `${headerHeight + 10}px`);
      }
      if (footer) {
        const footerHeight = footer.offsetHeight;
        this.renderer.setStyle(main, 'padding-bottom', `${footerHeight + 10}px`);
      }
    }
  }

  @HostListener('window:scroll', [])
  onWindowScroll(): void {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const header = this.el.nativeElement.querySelector('.header.position-fixed');
    if (scrollTop > 10) {
      this.renderer.addClass(header, 'active');
    } else {
      this.renderer.removeClass(header, 'active');
    }
  }

  @HostListener('window:resize', [])
  onResize(): void {
    // Update main container min-height on resize
    const main = this.el.nativeElement.querySelector('main');
    if (main) {
      const windowHeight = window.innerHeight;
      this.renderer.setStyle(main, 'min-height', `${windowHeight}px`);
    }
  }
}
