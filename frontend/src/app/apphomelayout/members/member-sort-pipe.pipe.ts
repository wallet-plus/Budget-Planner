import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'membersSort'
})
export class MembersSortPipe implements PipeTransform {
  transform(members: any[], order: 'asc' | 'desc' = 'asc'): any[] {
    return members.sort((a, b) => {
      const nameA = (a.firstname + ' ' + a.lastname).toLowerCase();
      const nameB = (b.firstname + ' ' + b.lastname).toLowerCase();
      return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    });
  }
}
