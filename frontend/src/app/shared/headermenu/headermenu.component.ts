import { Component, OnInit } from '@angular/core';
import { DeviceDetectorService } from 'ngx-device-detector';

@Component({
  selector: 'app-headermenu',
  templateUrl: './headermenu.component.html',
  styleUrls: ['./headermenu.component.scss'],
})
export class HeadermenuComponent implements OnInit {
  deviceInfo: any;
  isMobile: boolean = false;
  isTablet: boolean = false;
  isDesktop: boolean = false;
  constructor(private deviceService: DeviceDetectorService) {}
  ngOnInit(): void {
    // this.deviceInfo = this.deviceService.getDeviceInfo();
    this.isMobile = this.deviceService.isMobile();
    this.isTablet = this.deviceService.isTablet();
    this.isDesktop = this.deviceService.isDesktop();
  }

  menuopen() {
    const body = document.getElementsByTagName('body')[0];
    body.classList.toggle('menu-open');
  }

  share() {
    const text = encodeURIComponent(
      'Calculate zakat for free only on WalletPlus visit: ',
    );
    const url = encodeURIComponent(
      'https://secure.walletplus.in/zakat-calculator',
    );
    const whatsappUrl = `https://web.whatsapp.com/send?text=${text}${url}`;
    window.open(whatsappUrl, '_blank');
  }
}
