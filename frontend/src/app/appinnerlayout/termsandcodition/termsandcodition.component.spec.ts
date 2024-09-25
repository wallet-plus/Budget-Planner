import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TermsandcoditionComponent } from './termsandcodition.component';

describe('TermsandcoditionComponent', () => {
  let component: TermsandcoditionComponent;
  let fixture: ComponentFixture<TermsandcoditionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [TermsandcoditionComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(TermsandcoditionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
