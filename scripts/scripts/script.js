// Configuración del token CSRF para todas las solicitudes AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

class OrgChart {
    constructor() {
        this.data = null;
        this.selectedNode = null;
        this.initializeButtons();
        this.cargarDatos(); // Cargar datos al inicio
    }

    cargarDatos() {
        $.get('/nodos', (data) => {
            console.log('Datos recibidos:', data); // Verificar los datos recibidos
            if (data.length > 0) {
                this.data = data[0]; // Asumiendo que el primer nodo es el nodo raíz
                this.Inicio();
            } else {
                alert('No se encontraron datos en la base de datos.');
            }
        });
    }

    Inicio() {
        $('#chart-container').orgchart({
            'data': this.data,
            'nodeContent': 'departamento',
            'createNode': ($node, data) => {
                $node.addClass('node');
                this.EstructuraNodo($node, data);
                this.EdicionNodo($node, data);

                $node.on('click', () => {
                    this.selectedNode = data;
                    $('.node').removeClass('selected');
                    $node.addClass('selected');
                });
            },
        });
    }

    EstructuraNodo($node, data) {
        $node.html(`
            <div class="nodo-contenido">
                <div class="nodo-foto">
                    <img src="${data.foto}" alt="Foto de ${data.nombre}" />
                </div>
                <div class="nodo-info">
                    <div class="nodo-puesto">${data.puesto}</div>
                    <div class="nodo-nombre">${data.nombre}</div>
                    <div class="nodo-departamento">${data.departamento}</div>
                </div>
            </div>
        `);
    }

    EdicionNodo($node, data) {
        const puesto = $node.find('.nodo-puesto');
        puesto.attr('contenteditable', 'true');
        puesto.on('blur', () => {
            const nuevoPuesto = puesto.text();
            if (nuevoPuesto) {
                data.puesto = nuevoPuesto;
                this.refreshChart();
            }
        });

        const departamento = $node.find('.nodo-departamento');
        departamento.attr('contenteditable', 'true');
        departamento.on('blur', () => {
            const nuevoDepartamento = departamento.text().replace('Departamento: ', '');
            if (nuevoDepartamento) {
                data.departamento = nuevoDepartamento;
                this.refreshChart();
            }
        });
    }

    addNode(padre) {
        const nuevoNodo = {
            'puesto': 'Nuevo Puesto',
            'nombre': 'Nuevo Nombre',
            'foto': 'https://via.placeholder.com/50',
            'departamento': 'Nuevo Departamento',
            'children': []
        };

        if (padre && padre.children) {
            padre.children.push(nuevoNodo);
        } else {
            padre.children = [nuevoNodo];
        }

        this.refreshChart();
    }

    deleteNode(node) {
        this.removeNode(this.data, node);
        this.refreshChart();
    }

    removeNode(parent, nodeToRemove) {
        if (parent.children) {
            parent.children = parent.children.filter(child => child !== nodeToRemove);
            parent.children.forEach(child => this.removeNode(child, nodeToRemove));
        }
    }

    refreshChart() {
        $('#chart-container').empty();
        this.Inicio();
    }

    initializeButtons() {
        $('#addChildBtn').on('click', () => {
            if (this.selectedNode) {
                this.addNode(this.selectedNode);
            } else {
                alert("Por favor, selecciona un nodo primero.");
            }
        });

        $('#deleteNodeBtn').on('click', () => {
            if (this.selectedNode) {
                this.deleteNode(this.selectedNode);
            } else {
                alert("Por favor, selecciona un nodo primero.");
            }
        });

        $('#resetNodesBtn').on('click', () => this.resetNodes());

        $('#saveDataBtn').on('click', () => this.guardarDatos()); // Función para guardar los datos
    }

    guardarDatos() {
        $.ajax({
            url: '/guardar-organigrama',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(this.data),
            success: () => {
                alert('Datos guardados exitosamente.');
            },
            error: (xhr) => {
                console.error('Error al guardar los datos:', xhr);
                alert('Error al guardar los datos.');
            }
        });
    }

    resetNodes() {
        this.data.children = [];
        this.refreshChart();
    }
}

$(document).ready(() => {
    new OrgChart();
});