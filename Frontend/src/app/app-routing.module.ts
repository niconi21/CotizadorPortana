import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClienteComponent } from './cliente/cliente.component';
import { CotizacionComponent } from './cotizacion/cotizacion.component';
import { CotizacionesAnterioresComponent } from './cotizaciones-anteriores/cotizaciones-anteriores.component';
import { IngredienteComponent } from './ingrediente/ingrediente.component';
import { EmpleadoComponent } from './empleado/empleado.component';
import { SalarioComponent } from './salario/salario.component';
import { NotaComponent } from './cotizacion/components/nota/nota.component';

const routes: Routes = [
  { path: 'cotizacion', component: CotizacionComponent },
  { path: 'nota', component: NotaComponent },
  { path: 'historial', component: CotizacionesAnterioresComponent },
  { path: 'cliente', component: ClienteComponent },
  { path: 'ingrediente', component: IngredienteComponent },
  { path: 'empleado', component: EmpleadoComponent },
  { path: 'salario', component: SalarioComponent },
  { path: '**', pathMatch:'full', redirectTo:'cotizacion' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {useHash: true})],
  exports: [RouterModule],
})
export class AppRoutingModule {}
