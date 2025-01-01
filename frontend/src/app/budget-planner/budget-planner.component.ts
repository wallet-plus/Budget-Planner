import { Component, ElementRef, Renderer2, ViewChild } from '@angular/core';

@Component({
  selector: 'app-budget-planner',
  templateUrl: './budget-planner.component.html',
  styleUrls: ['./budget-planner.component.scss']
})
export class BudgetPlannerComponent {
  @ViewChild('HeaderEl', { read: ElementRef, static: false })
  headerView!: ElementRef;
  @ViewChild('mainPage', { read: ElementRef, static: false })
  mainPageView!: ElementRef;
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
        'padding-bottom',
        `${this.headerView.nativeElement.offsetHeight + 10}px`,
      );
      this.renderer.setStyle(
        this.mainPageView.nativeElement,
        'min-height',
        `${window.outerHeight}px`,
      );
    }
}
