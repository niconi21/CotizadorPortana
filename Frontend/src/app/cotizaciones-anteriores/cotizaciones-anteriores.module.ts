import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CotizacionesAnterioresRoutingModule } from './cotizaciones-anteriores-routing.module';
import { CotizacionesAnterioresComponent } from './cotizaciones-anteriores.component';


@NgModule({
  declarations: [
    CotizacionesAnterioresComponent
  ],
  imports: [
    CommonModule,
    CotizacionesAnterioresRoutingModule
  ]
})
export class CotizacionesAnterioresModule { }
