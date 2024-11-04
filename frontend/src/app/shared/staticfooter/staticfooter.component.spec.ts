import { ComponentFixture, TestBed } from '@angular/core/testing';

import { StaticfooterComponent } from './staticfooter.component';

describe('StaticfooterComponent', () => {
  let component: StaticfooterComponent;
  let fixture: ComponentFixture<StaticfooterComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [StaticfooterComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(StaticfooterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
