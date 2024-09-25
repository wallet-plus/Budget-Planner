import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup } from '@angular/forms';
import { ZakatService } from 'src/app/services/zakat.service';

@Component({
  selector: 'app-zakat-calculator',
  templateUrl: './zakat-calculator.component.html',
  styleUrls: ['./zakat-calculator.component.scss'],
})
export class ZakatCalulatorComponent implements OnInit {
  zakatForm: FormGroup;
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
    const value = $event.target.value.replace(/[a-zA-Z%@*^$!`)(_+=#&\s]/g, '');
    $event.target.value = value;
  }

  ngOnInit(): void {
    this.zakatForm = this.fb.group({});
    // this.getCountries();
    this.getZakatCategories();
  }

  getZakatCategories() {
    this.zakatService.getCategories().subscribe((resp: any) => {
      this.categoryList = resp.list;
      this.categoryList.forEach((category: any) => {
        const categories: any = [];
        this.categoryList.forEach((cat: any) => {
          if (category.id_category == cat.parent) {
            categories.push(cat);
          }
        });
        category.child = categories;

        this.zakatForm.addControl(
          category.id_category.toString(),
          new FormControl('no'),
        );
        this.zakatForm.addControl(
          `${category.id_category.toString()}_quantity`,
          new FormControl(0),
        );
      });

      this.zakatService.getLocationPrices(1).subscribe((resp: any) => {
        this.pricesData = resp.list;
        this.categoryList.forEach((category: any) => {
          category.price = 1;
          this.pricesData.forEach((pD: any) => {
            if (pD.id_category == category.id_category) {
              category.price = pD.price ? pD.price : 1;
            }
          });
        });
      });
    });
  }

  getChildCategories(category: any) {
    const categories = [];
  }

  checkZakatAmount() {}

  checkCategoryZakatAmount(category: any) {
    // this.totalZakatAmount = 0;
    const quantity = parseFloat(
      this.zakatForm.controls[`${category.id_category}_quantity`].value,
    );
    category.categoryAmount = (
      this.zakatForm.controls[`${category.id_category}_quantity`].value *
      parseFloat(category.price)
    ).toFixed(2);
    if (quantity >= category.min) {
      if (category.categoryAmount && category.percentage) {
        category.zakatMessage = null;
        category.zakatAmount = (
          (category.categoryAmount * parseFloat(category.percentage)) /
          100
        ).toFixed(2);
      }
    } else {
      category.zakatAmount = 0;
      category.zakatMessage = ` No Zakat (Min Quantity ${category.min} ${category.units}.)`;
    }

    this.totalZakatAmount = 0;
    this.categoryList.forEach((cat: any) => {
      if (cat.zakatAmount) {
        this.totalZakatAmount += parseFloat(cat.zakatAmount);
      }
    });
  }
}
