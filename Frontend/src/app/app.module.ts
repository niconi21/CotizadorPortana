import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RouterModule } from '@angular/router';
import { ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { SalarioModule } from './salario/salario.module';
import { ClienteModule } from './cliente/cliente.module';
import { CotizacionModule } from './cotizacion/cotizacion.module';
import { CotizacionesAnterioresModule } from './cotizaciones-anteriores/cotizaciones-anteriores.module';
import { IngredienteModule } from './ingrediente/ingrediente.module';
import { EmpleadoModule } from './empleado/empleado.module';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  declarations: [AppComponent],
  imports: [
    CommonModule,
    BrowserModule,
    RouterModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    SalarioModule,
    ClienteModule,
    CotizacionModule,
    CotizacionesAnterioresModule,
    IngredienteModule,
    EmpleadoModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
