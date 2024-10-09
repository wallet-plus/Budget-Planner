import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ZakatCalulatorComponent } from './zakat-calculator.component';

describe('ZakatCalulatorComponent', () => {
  let component: ZakatCalulatorComponent;
  let fixture: ComponentFixture<ZakatCalulatorComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ZakatCalulatorComponent],
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ZakatCalulatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
