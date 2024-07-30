import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BaseComponent } from './base/base.component';
import { RouterModule, Routes } from '@angular/router';
import { SideMenuComponent } from './side-menu/side-menu.component';
import { HeaderMenuComponent } from './header-menu/header-menu.component';

const routes: Routes = [ ];

@NgModule({
  declarations: [
    BaseComponent,
    SideMenuComponent,
    HeaderMenuComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    RouterModule,
  ],
  exports : [
    BaseComponent
  ]
})
export class ThemeModule { }
