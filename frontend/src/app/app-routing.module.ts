import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthlayoutRoutingModule } from './authlayout/authlayout-routing.module';
import { AppinnerlayoutRoutingModule } from './appinnerlayout/appinner-routing.module';
import { ApphomelayoutRoutingModule } from './apphomelayout/apphome-routing.module';

const routes: Routes = [
  {
    path: '**',
    redirectTo: '/pagenotfound',
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes),
    AuthlayoutRoutingModule,
    AppinnerlayoutRoutingModule,
    ApphomelayoutRoutingModule,
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
