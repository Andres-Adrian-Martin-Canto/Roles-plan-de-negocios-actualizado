export class ObjectFila {
    constructor(id,name, valor1, valor2, total, status) {
        this.id = id;
        this.name = name;
        this.valor1 = +valor1 ||  '';
        this.valor2 = +valor2 ||  '';
        this.total = +total ||  '';
        this.status = status;
    }
}
