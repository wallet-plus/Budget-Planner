import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filterByCategoryType'
})
export class FilterByCategoryTypePipe implements PipeTransform {

  transform(categoryList: any[], idType: number): any[] {
    if (!categoryList || idType === undefined || idType === null) {
      return categoryList; // Return the original list if no filter criteria
    }
    return categoryList.filter((category) => category.id_type == idType);
  }

}
