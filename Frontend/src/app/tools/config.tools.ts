import Swal, { SweetAlertIcon, SweetAlertResult } from 'sweetalert2';

export class Config {
  

  public configSwal(
    title: string,
    icon: SweetAlertIcon
  ): Promise<SweetAlertResult<any>> {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    return Toast.fire({
      icon,
      title,
    });
  }
}
