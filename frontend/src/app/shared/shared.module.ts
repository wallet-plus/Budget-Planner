import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { LoaderComponent } from './loader/loader.component';
import { StaticfooterComponent } from './staticfooter/staticfooter.component';
import { HeadermenuComponent } from './headermenu/headermenu.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  declarations: [LoaderComponent,
    StaticfooterComponent,
    HeadermenuComponent,
    SidebarComponent
  ],
  imports: [CommonModule, RouterModule,
    TranslateModule.forChild()
  ],
  exports: [LoaderComponent,
    StaticfooterComponent,
    HeadermenuComponent,
    SidebarComponent
  ],

})
export class SharedModule { }
