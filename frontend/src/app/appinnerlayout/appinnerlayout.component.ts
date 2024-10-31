import {
  Component,
  HostListener,
  ViewChild,
  ElementRef,
  Renderer2,
  AfterViewInit,
} from '@angular/core';

@Component({
  selector: 'app-appinnerlayout',
  templateUrl: './appinnerlayout.component.html',
  styleUrls: ['./appinnerlayout.component.scss'],
})
export class AppinnerlayoutComponent implements AfterViewInit {
  @ViewChild('HeaderEl', { read: ElementRef, static: false })
  headerView!: ElementRef;
  @ViewChild('mainPage', { read: ElementRef, static: false })
  mainPageView!: ElementRef;
  @ViewChild('mainContainer', { read: ElementRef, static: false })
  mainContainerView!: ElementRef;
  @ViewChild('FooterEl', { read: ElementRef, static: false })
  footerView!: ElementRef;

  constructor(private renderer: Renderer2) {}

  ngAfterViewInit() {
    this.renderer.setStyle(
      this.mainPageView.nativeElement,
      'padding-top',
      `${this.headerView.nativeElement.offsetHeight + 10}px`,
    );
    this.renderer.setStyle(
      this.mainPageView.nativeElement,
      'min-height',
      `${window.outerHeight}px`,
    );
    this.renderer.setStyle(
      this.mainContainerView.nativeElement,
      'min-height',
      `${
        window.outerHeight -
        this.headerView.nativeElement.offsetHeight -
        10 -
        this.footerView.nativeElement.offsetHeight
      }px`,
    );
  }

  @HostListener('window:scroll', [])
  onWindowScroll() {
    const header = document.getElementsByTagName('app-headerback')[0];
    const main = document.getElementsByTagName('html')[0];

    if (main.scrollTop > 15) {
      header.classList.add('active');
    } else {
      header.classList.remove('active');
    }
  }
}
