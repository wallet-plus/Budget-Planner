import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BaseComponent } from './base/base.component';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [ ];

@NgModule({
  declarations: [
    BaseComponent
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
