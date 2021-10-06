import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { ISalario } from '../../interfaces/salario.interface';

@Injectable({
  providedIn: 'root',
})
export class SalarioService {
  private _url = `${environment.backend}/salario.php`;

  constructor(private _http: HttpClient) {}

  public getSalarios() {
    return this._http.get(this._url).toPromise();
  }
  public setSalario(salario: ISalario) {
    return this._http.post(this._url, salario).toPromise();
  }
  public updateSalario(salario: ISalario) {
    return this._http.put(this._url, salario).toPromise();
  }
}
