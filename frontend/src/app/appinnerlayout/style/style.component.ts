import { Component, Renderer2 } from '@angular/core';

@Component({
  selector: 'app-style',
  templateUrl: './style.component.html',
  styleUrls: ['./style.component.scss'],
})
export class StyleComponent {
  isChecked: boolean = false;
  isdarkmode: boolean = false;
  isrtl: boolean = false;

  constructor(private renderer: Renderer2) {}

  stylechange(e: any) {
    const bodyEl = document.getElementsByTagName('body')[0];
    const currentClass: any = bodyEl.getAttribute('data-color');
    bodyEl.classList.remove(currentClass);

    const setstyle = e.target.getAttribute('data-title');
    if (setstyle !== '') {
      bodyEl.classList.add(setstyle);
      bodyEl.setAttribute('data-color', setstyle);
    }
  }

  bgchange(e: any) {
    const bodyEl = document.getElementsByTagName('body')[0];
    const currentClass: any = bodyEl.getAttribute('data-bg');
    bodyEl.classList.remove(currentClass);

    const setbg = e.target.getAttribute('data-title');
    if (setbg !== '') {
      bodyEl.classList.add(setbg);
      bodyEl.setAttribute('data-bg', setbg);
    }
  }

  modechangedark(e: any) {
    const html = document.getElementsByTagName('html')[0];
    this.isdarkmode = true;
    html.classList.add('dark-mode');
  }

  modechangelight(e: any) {
    const html = document.getElementsByTagName('html')[0];
    this.isdarkmode = false;
    html.classList.remove('dark-mode');
  }

  layoutrtl(e: any) {
    const body = document.getElementsByTagName('body')[0];
    this.isrtl = true;
    body.classList.add('rtl');
  }

  layoutltr(e: any) {
    const body = document.getElementsByTagName('body')[0];
    this.isrtl = false;
    body.classList.remove('rtl');
  }
}
