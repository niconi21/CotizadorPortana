import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CotizacionRoutingModule } from './cotizacion-routing.module';
import { CotizacionComponent } from './cotizacion.component';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';


@NgModule({
  declarations: [
    CotizacionComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    CotizacionRoutingModule,
    ReactiveFormsModule
  ]
})
export class CotizacionModule { }
