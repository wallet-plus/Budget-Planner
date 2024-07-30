import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PersonalFinanceComponent } from './personal-finance.component';

describe('PersonalFinanceComponent', () => {
  let component: PersonalFinanceComponent;
  let fixture: ComponentFixture<PersonalFinanceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PersonalFinanceComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PersonalFinanceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
