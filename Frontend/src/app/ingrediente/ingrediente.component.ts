import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { FormValidator } from '../tools/form.tools';

@Component({
  selector: 'app-ingrediente',
  templateUrl: './ingrediente.component.html',
})
export class IngredienteComponent implements OnInit {

  public form: FormGroup;
  public FormValidator: FormValidator;
  constructor(private _formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this._construirForm()
  }

  private _construirForm() {
    this.form = this._formBuilder.group({
      nombre: ['', [Validators.required]],
      tipo: ['', [Validators.required]],
      precio: ['', [Validators.required]],
      aplicable: ['', [Validators.required]],
    });
    this.FormValidator = new FormValidator(this.form);
  }

  public agregarIngrediente() {
    if (this.form.invalid) {
      Object.values(this.form.controls).forEach((control) =>
        control.markAllAsTouched()
      );
    }
    console.log(this.form.status);
  }

}
