import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ApphomelayoutComponent } from './apphomelayout.component';

describe('ApphomelayoutComponent', () => {
  let component: ApphomelayoutComponent;
  let fixture: ComponentFixture<ApphomelayoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ApphomelayoutComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ApphomelayoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
