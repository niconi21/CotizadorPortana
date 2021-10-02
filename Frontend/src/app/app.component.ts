import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';
import { IMenuCategoria, IMenuItem } from './interfaces/IMenu.interface';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent implements OnInit {
  public title = 'Nueva cotización';

  public categoriasMenu: IMenuCategoria[] = [
    {
      titulo: 'Cotización',
      items: [
        { icon: 'briefcase', text: 'Nueva cotización', url: 'cotizacion' },
        { icon: 'history', text: 'Cotizaciónes anteriores', url: 'historial' },
      ],
    },
    {
      titulo: 'Herramientas',
      items: [
        { icon: 'users', text: 'Clientes registrados', url: 'cliente' },
        {
          icon: 'hammer',
          text: 'Ingredientes registrados',
          url: 'ingrediente',
        },
      ],
    },
    {
      titulo: 'Administración',
      items: [
        { icon: 'portrait', text: 'Empleados registrados', url: 'empleado' },
        { icon: 'money-bill-alt', text: 'Salarios', url: 'salario' },
      ],
    },
  ];

  constructor() {}
  ngOnInit(): void {
    this._animacionSideBar();
    // this._paginaActual();
  }

  public paginaActual(item: IMenuItem){
    this.title = item.text
  }

  private _paginaActual() {
    let url = location.href;
    let urlPartes = url.split('/');
    let actualURL = urlPartes[urlPartes.length - 1];
    let actualTitle: IMenuItem;
    this.categoriasMenu.forEach((categoria) => {
      actualTitle = categoria.items.find((item) => (item.url == actualURL));
    });

    this.title = actualTitle.text
  }
  
  private _animacionSideBar() {
    $('#sidebarToggle, #sidebarToggleTop').on('click', function (e) {
      $('body').toggleClass('sidebar-toggled');
      $('.sidebar').toggleClass('toggled');
    });

    $(document).on('scroll', function () {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });

    $(document).on('click', 'a.scroll-to-top', function (e) {
      var $anchor = $(this);
      $('html, body')
        .stop()
        .animate(
          {
            scrollTop: $($anchor.attr('href')).offset().top,
          },
          1000,
          'easeInOutExpo'
        );
      e.preventDefault();
    });
  }
}
