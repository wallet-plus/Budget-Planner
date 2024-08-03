import { TestBed } from '@angular/core/testing';

import { PersonalFinanceService } from './personal-finance.service';

describe('PersonalFinanceService', () => {
  let service: PersonalFinanceService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PersonalFinanceService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
