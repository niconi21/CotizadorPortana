import { FormGroup, FormArray } from '@angular/forms';
export class FormValidator {
  private form: FormGroup;
  constructor(form) {
    this.form = form;
  }

  public getStatus(input: string) {
    return this.form.get(input).invalid && this.form.get(input).touched;
  }

  public getStatusGroup(group: string, input: string) {
    return (
      this.form.controls[group].get(input).invalid &&
      this.form.controls[group].get(input).touched
    );
  }

  public getStatusGroupArray(group: string, index, input: string) {
    return (
      (this.form.controls[group]as FormArray).at(index).get(input).invalid &&
      (this.form.controls[group]as FormArray).at(index).get(input).touched
    );
  }
}
