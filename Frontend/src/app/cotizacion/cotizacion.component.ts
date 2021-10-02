import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { FormValidator } from '../tools/form.tools';

@Component({
  selector: 'app-cotizacion',
  templateUrl: './cotizacion.component.html',
})
export class CotizacionComponent implements OnInit {
  public formCliente: FormGroup;
  public formCotizacion: FormGroup;
  public formValidatorCliente: FormValidator;
  public formValidatorCotizacion: FormValidator;

  constructor(private _formBuilder: FormBuilder) {}

  ngOnInit(): void {
    this._construirForm();
  }

  private _construirForm() {
    this.formCliente = this._formBuilder.group({
      nombre: ['', [Validators.required]],
      direccion: ['', [Validators.required]],
      telefono: ['', [Validators.required]],
    });
    this.formValidatorCliente = new FormValidator(this.formCliente);

    this.formCotizacion = this._formBuilder.group({
      proyecto: this._formBuilder.group({
        tipo: ['Puerta', [Validators.required]],
        material: ['Herrería', [Validators.required]],
        descripcion: ['', [Validators.required]],
      }),
      materiales: this._formBuilder.array([]),
      cristaleria: this._formBuilder.array([]),
      pintura: this._formBuilder.array([]),
      acabados: this._formBuilder.array([]),
      manoObra: this._formBuilder.array([]),
      porcentaje: ['10', [Validators.required]]
    });
    this.formValidatorCotizacion = new FormValidator(this.formCotizacion);
    this.agregarRowMaterial();
    this.agregarRowCristaleria();
    this.agregarRowPintura();
    this.agregarRowAcabados();
    this.agregarRowManoObra();
  }

  public agregarRowMaterial() {
    let material = this._formBuilder.group({
      perfil: ['M-50', [Validators.required]],
      longitud: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.getFormArray('materiales').push(material);
  }
  public eliminarRowMaterial(index: number) {
    this.getFormArray('materiales').removeAt(index);
  }

  public agregarRowCristaleria() {
    let cristal = this._formBuilder.group({
      tipo: ['8 mm', [Validators.required]],
      ancho: ['', [Validators.required]],
      largo: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.getFormArray('cristaleria').push(cristal);
  }

  public eliminarRowCristaleria(index: number) {
    this.getFormArray('cristaleria').removeAt(index);
  }

  public agregarRowPintura() {
    let pintura = this._formBuilder.group({
      tipo: ['Primer', [Validators.required]],
      color: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.getFormArray('pintura').push(pintura);
  }

  public eliminarRowPitura(index: number) {
    this.getFormArray('pintura').removeAt(index);
  }

  public agregarRowAcabados() {
    let acabado = this._formBuilder.group({
      tipo: ['Chapa', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.getFormArray('acabados').push(acabado);
  }

  public eliminarRowAcabados(index: number) {
    this.getFormArray('acabados').removeAt(index);
  }

  public agregarRowManoObra() {
    let manoObra = this._formBuilder.group({
      empleado: ['', [Validators.required]],
      tipo: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
      descripcion: ['', [Validators.required]],
    });
    this.getFormArray('manoObra').push(manoObra);
  }

  public eliminarRowManoObra(index: number) {
    this.getFormArray('manoObra').removeAt(index);
  }

  public getFormArray(name: string) {
    return this.formCotizacion.controls[name] as FormArray;
  }

  public agregarCliente() {
    if(this.formCliente.invalid){
      return Object.values(this.formCliente.controls).forEach(control => control.markAllAsTouched())
    }
    console.log('FormCliente', this.formCliente.status);
  }

  public agregarCotizacion() {
    if(this.formCotizacion.invalid){
      return Object.values(this.formCotizacion.controls).forEach(control => control.markAllAsTouched())
    }
    console.log('FormCotizacion', this.formCotizacion.status);
  }
}
