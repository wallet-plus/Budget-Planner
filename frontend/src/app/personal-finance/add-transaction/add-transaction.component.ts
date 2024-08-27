import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Category, CategoryListRequest, CategoryListResponse } from 'src/app/services/personal-finance.model';
import { PersonalFinanceService } from 'src/app/services/personal-finance.service';

@Component({
  selector: 'app-add-transaction',
  templateUrl: './add-transaction.component.html',
  styleUrls: ['./add-transaction.component.scss']
})
export class AddTransactionComponent implements OnInit {

  categories: Category[] = [];

  expenseForm: FormGroup;

  constructor(private personalFinanceService: PersonalFinanceService, private fb: FormBuilder) {

    this.expenseForm = this.fb.group({
      date_of_transaction: [null, Validators.required],
      description: [''],
      expense_name: [''],
      id_category: [null, Validators.required],
      id_customer: [null, Validators.required],
      id_expense: [null, Validators.required],
      id_type: [2], // Default id_type set to 2
      amount: [null, Validators.required],
      deleted: [false]
    });

  }

  ngOnInit(): void {
    const request: CategoryListRequest = { type: 'expense' };
    this.personalFinanceService.getCategoryList(request).subscribe((response: any) => {
      this.categories = response;
    });
  }

  saveTransaction(): void {
    if (this.expenseForm.valid) {
      const requestPayload = this.expenseForm.value;
      this.personalFinanceService.add(requestPayload).subscribe({
        next: (response) => {
          console.log('Transaction saved successfully:', response);
          // Handle successful response here
        },
        error: (error) => {
          console.error('Error saving transaction:', error);
          // Handle error here
        }
      });
    } else {
      console.log('Form is invalid');
    }
  }
  

}
 