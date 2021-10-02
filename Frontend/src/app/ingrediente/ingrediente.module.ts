import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { IngredienteRoutingModule } from './ingrediente-routing.module';
import { IngredienteComponent } from './ingrediente.component';
import { ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [
    IngredienteComponent
  ],
  imports: [
    CommonModule,
    IngredienteRoutingModule,
    ReactiveFormsModule
  ]
})
export class IngredienteModule { }
