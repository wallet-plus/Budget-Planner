import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AppinnerlayoutComponent } from './appinnerlayout.component';

describe('AppinnerlayoutComponent', () => {
  let component: AppinnerlayoutComponent;
  let fixture: ComponentFixture<AppinnerlayoutComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [AppinnerlayoutComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AppinnerlayoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
