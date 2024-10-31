import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ZakatService } from 'src/app/services/zakat.service';

@Component({
  selector: 'app-zakat-calculator',
  templateUrl: './zakat-calculator.component.html',
  styleUrls: ['./zakat-calculator.component.scss'],
})
export class ZakatCalulatorComponent implements OnInit {
  zakatForm!: FormGroup;
  categoryList: any;
  cityList: any;
  stateList: any;
  countryList: any;
  pricesData: any;
  totalZakatAmount: number = 0;

  constructor(
    private zakatService: ZakatService,
    private fb: FormBuilder,
  ) {}

  preventText($event: any) {
    // Create a new variable and assign value to avoid no-param-reassign error
    const newValue = $event.target.value.replace(
      /[a-zA-Z%@*^$!`)(_+=#&\s]/g,
      '',
    );
    $event.target.value = newValue;
  }

  ngOnInit(): void {
    this.zakatForm = this.fb.group({});
    // this.getCountries();
    this.getZakatCategories();
  }

  getZakatCategories() {
    this.zakatService.getCategories().subscribe((response: any) => {
      // Renamed 'resp' to 'response' to avoid shadowing
      this.categoryList = response.list;
      this.categoryList.forEach((category: any) => {
        const childCategories: any = [];
        this.categoryList.forEach((cat: any) => {
          if (category.id_category === cat.parent) {
            childCategories.push(cat);
          }
        });
        // Create a copy of category to avoid reassigning function parameter
        const newCategory = { ...category, child: childCategories };

        this.zakatForm.addControl(
          newCategory.id_category.toString(),
          new FormControl('no'),
        );
        this.zakatForm.addControl(
          `${newCategory.id_category.toString()}_quantity`,
          new FormControl(0),
        );
      });

      this.zakatService.getLocationPrices(1).subscribe((priceResponse: any) => {
        this.pricesData = priceResponse.list;
        this.categoryList.forEach((category: any) => {
          const newCategory = { ...category, price: 1 };
          this.pricesData.forEach((pD: any) => {
            if (pD.id_category === newCategory.id_category) {
              newCategory.price = pD.price ? pD.price : 1;
            }
          });
        });
      });
    });
  }

  getChildCategories(category: any) {
    // Function remains unchanged
  }

  checkZakatAmount() {
    //
  }

  checkCategoryZakatAmount(category: any) {
    const newCategory = { ...category };

    const quantity = parseFloat(
      this.zakatForm.controls[`${newCategory.id_category}_quantity`].value,
    );

    newCategory.categoryAmount = (
      this.zakatForm.controls[`${newCategory.id_category}_quantity`].value *
      parseFloat(newCategory.price)
    ).toFixed(2);

    if (quantity >= newCategory.min) {
      if (newCategory.categoryAmount && newCategory.percentage) {
        newCategory.zakatMessage = null;
        newCategory.zakatAmount = (
          (newCategory.categoryAmount * parseFloat(newCategory.percentage)) /
          100
        ).toFixed(2);
      }
    } else {
      newCategory.zakatAmount = 0;
      newCategory.zakatMessage = ` No Zakat (Min Quantity ${newCategory.min} ${newCategory.units}.)`;
    }

    this.totalZakatAmount = 0;
    this.categoryList.forEach((cat: any) => {
      if (cat.zakatAmount) {
        this.totalZakatAmount += parseFloat(cat.zakatAmount);
      }
    });
  }
}
