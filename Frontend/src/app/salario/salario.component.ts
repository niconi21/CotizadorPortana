import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormValidator } from '../tools/form.tools';
import { SalarioService } from './services/salario.service';
import { ISalario } from '../interfaces/salario.interface';
import * as $ from 'jquery';
import { Config } from '../tools/config.tools';
@Component({
  selector: 'app-salario',
  templateUrl: './salario.component.html',
})
export class SalarioComponent implements OnInit {
  private _isOpenForm = false;
  private _id: number = null;
  private _config = new Config();

  public form: FormGroup;
  public FormValidator: FormValidator;
  public isacutalizarSalario = false;
  public salarios: ISalario[] = [];

  constructor(
    private _formBuilder: FormBuilder,
    private _salarioService: SalarioService
  ) {}

  ngOnInit(): void {
    this._construirForm();
    this._obtenerSalarios();
  }

  private _construirForm() {
    this.form = this._formBuilder.group({
      nombre: ['', [Validators.required]],
      cantidad: ['', [Validators.required]],
    });
    this.FormValidator = new FormValidator(this.form);
  }

  private _obtenerSalarios() {
    this._salarioService.getSalarios().then((resp) => {
      this.salarios = resp['result'];
    });
  }

  public agregarSalario() {
    if (this.form.invalid) {
      return Object.values(this.form.controls).forEach((control) =>
        control.markAllAsTouched()
      );
    }
    let { nombre, cantidad } = this.form.controls;

    let salario: ISalario = {
      nombre: nombre.value,
      cantidad: cantidad.value,
    };
    if (!this.isacutalizarSalario)
      this._salarioService.setSalario(salario).then((resp) => {
        this._obtenerSalarios();
        this.form.reset({
          nombre: '',
          cantidad: '',
        });
        this.accionFormSalario()
        this._config.configSwal(resp['message'], 'success')
      });
    else {
      salario.id = this._id;
      this._salarioService.updateSalario(salario).then( resp=>{
        console.log(resp);
        this._obtenerSalarios()
        this.form.reset({ nombre: '', cantidad: ''})
        this.accionFormSalario()
        this._config.configSwal(resp['message'], 'info')
      })
    }
  }

  public editarSalario(salario: ISalario) {
    if (!this._isOpenForm) this.accionFormSalario();
    this.isacutalizarSalario = true;
    this.form.reset({
      nombre: salario.nombre,
      cantidad: salario.cantidad,
    });
    this._id = salario.id;
  }

  public accionFormSalario() {
    $('#formSalario').fadeToggle();
    this._isOpenForm = !this._isOpenForm;
    this.isacutalizarSalario = false;
  }
}
