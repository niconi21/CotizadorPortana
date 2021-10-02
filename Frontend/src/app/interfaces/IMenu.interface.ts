export interface IMenuCategoria {
  titulo: string;
  items: IMenuItem[];
}

export interface IMenuItem{
  icon: string; text: string; url: string
}