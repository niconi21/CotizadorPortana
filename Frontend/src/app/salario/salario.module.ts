import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from "@angular/common/http";
import { SalarioRoutingModule } from './salario-routing.module';
import { SalarioComponent } from './salario.component';
import { ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [
    SalarioComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    HttpClientModule,
    SalarioRoutingModule,
    ReactiveFormsModule
  ]
})
export class SalarioModule { }
