import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormValidator } from '../tools/form.tools';

@Component({
  selector: 'app-salario',
  templateUrl: './salario.component.html',
})
export class SalarioComponent implements OnInit {
  public form: FormGroup;
  public FormValidator: FormValidator;

  constructor(private _formBuilder: FormBuilder) {}

  ngOnInit(): void {
    this._construirForm();
  }

  private _construirForm() {
    this.form = this._formBuilder.group({
      nombre: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.FormValidator = new FormValidator(this.form);
  }

  public agregarSalario() {
    if(this.form.invalid){
      Object.values(this.form.controls).forEach( control => control.markAllAsTouched())
    }
    console.log(this.form.status);
  }
}
