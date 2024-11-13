// member-filter.pipe.ts
import { Pipe, PipeTransform } from '@angular/core';

interface Member {
  firstname: string;
  lastname: string;
  member_name?: string;
  phone_number?: string;
  category_image?: string;
}

@Pipe({
  name: 'memberSearch'
})
export class MemberSearchPipe implements PipeTransform {
  transform(memberList: Member[], searchTerm: string): Member[] {
    if (!searchTerm) return memberList;
    const lowerCaseTerm = searchTerm.toLowerCase();
    return memberList.filter(member =>
      (member.firstname && member.firstname.toLowerCase().includes(lowerCaseTerm)) ||
      (member.lastname && member.lastname.toLowerCase().includes(lowerCaseTerm)) ||
      (member.member_name && member.member_name.toLowerCase().includes(lowerCaseTerm))
    );
  }
}
