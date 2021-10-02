import { Component, OnInit } from '@angular/core';
import { FormValidator } from '../tools/form.tools';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';

@Component({
  selector: 'app-empleado',
  templateUrl: './empleado.component.html',
})
export class EmpleadoComponent implements OnInit {
  public form: FormGroup;
  public FormValidator: FormValidator;

  constructor(private _formBuilder: FormBuilder) {}

  ngOnInit(): void {
    this._construirForm();
  }

  private _construirForm() {
    this.form = this._formBuilder.group({
      nombre: ['', [Validators.required]],
      telefono: ['', [Validators.required]],
    });
    this.FormValidator = new FormValidator(this.form);
  }

  public agregarEmpleado() {
    if (this.form.invalid) {
      Object.values(this.form.controls).forEach((control) =>
        control.markAllAsTouched()
      );
    }
    console.log(this.form.status);
  }
}
