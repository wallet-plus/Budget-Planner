import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FooterinfoComponent } from './footerinfo.component';

describe('FooterinfoComponent', () => {
  let component: FooterinfoComponent;
  let fixture: ComponentFixture<FooterinfoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FooterinfoComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FooterinfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
