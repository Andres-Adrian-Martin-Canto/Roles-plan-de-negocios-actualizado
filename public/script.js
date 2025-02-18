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
        this.tempId = -1; // Inicializar el ID temporal
        this.initializeButtons();
        this.cargarDatos(); 
        this.initializeUploadHandler(); // Inicializar el manejador de subida
    }

    // Generar un ID temporal único
    generateTempId() {
        return this.tempId--;
    }

    // Función para transformar la estructura recursiva de children_recursive a children
    transformarNodos(nodo) {
        return {
            id: nodo.id,
            puesto: nodo.puesto,
            codigo: nodo.codigo,
            foto: nodo.foto, // Preservar la cadena base64 o URL de la imagen
            parent_id: nodo.parent_id,
            organigrama_id: nodo.organigrama_id,
            children: nodo.children_recursive ? nodo.children_recursive.map(child => this.transformarNodos(child)) : []
        };
    }

    // Función para encontrar un nodo por ID en el árbol
    findNodeById(id, node = this.data) {
        if (node.id === id) {
            return node;
        }
        if (node.children && node.children.length > 0) {
            for (let child of node.children) {
                const result = this.findNodeById(id, child);
                if (result) return result;
            }
        }
        return null;
    }

    // Cargar los datos del servidor
    cargarDatos() {
        const organigramaId = $('#chart-container').data('organigrama-id');
        $.get(`/nodos/data?organigrama_id=${organigramaId}`, (data) => {
            if (data.length > 0) {
                this.data = this.transformarNodos(data[0]); // Transformar estructura recursiva
                this.Inicio();
            } else {
                alert('No se encontraron datos en la base de datos.');
            }
        }).fail((xhr, status, error) => {
            console.error('Error al cargar datos:', xhr.responseText);
            alert('Error al cargar los datos. Inténtalo de nuevo.');
        });
    }

    // Inicializar y renderizar el organigrama
    Inicio() {
        $('#chart-container').orgchart({
            'data': this.data,
            'nodeContent': 'puesto',
            'createNode': ($node, data) => {
                $node.addClass('node');
                this.EstructuraNodo($node, data);
                this.EdicionNodo($node, data);

                $node.on('click', () => {
                    this.selectedNode = data;
                    console.log('Nodo seleccionado:', this.selectedNode); // Depuración
                    $('.node').removeClass('selected');
                    $node.addClass('selected');
                });

                // Agregar evento de doble clic a la imagen del nodo
                $node.find('img').on('dblclick', () => {
                    this.selectedNode = data;
                    console.log('Nodo seleccionado para subir foto:', this.selectedNode); // Depuración
                    $('#uploadPhotoInput').click();
                });
            },
        });
    }

    // Estructurar el contenido HTML de cada nodo
    EstructuraNodo($node, data) {
        $node.html(`
            <div class="nodo-contenido">
                <div class="nodo-foto">
                    <img src="${data.foto}" alt="Foto de ${data.puesto}" data-id="${data.id}" />
                </div>
                <div class="nodo-info">
                    <div class="nodo-puesto" contenteditable="true">${data.puesto}</div>
                    <div class="nodo-codigo" contenteditable="true">${data.codigo}</div>
                </div>
            </div>
        `);
    }

    // Manejar la edición de campos del nodo
    EdicionNodo($node, data) {
        const puesto = $node.find('.nodo-puesto');
        puesto.on('blur', () => {
            const nuevoPuesto = puesto.text().trim();
            if (nuevoPuesto && nuevoPuesto !== data.puesto) {
                data.puesto = nuevoPuesto;
                this.updateNode(data); // Actualizar el nodo en el servidor
            }
        });

        const codigo = $node.find('.nodo-codigo');
        codigo.on('blur', () => {
            const nuevoCodigo = codigo.text().trim();
            if (nuevoCodigo && nuevoCodigo !== data.codigo) {
                data.codigo = nuevoCodigo;
                this.updateNode(data); // Actualizar el nodo en el servidor
            }
        });
    }

    updateNode(data) {
        $.ajax({
            url: '/nodos/' + data.id,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({
                'puesto': data.puesto,
                'codigo': data.codigo,
                'foto': data.foto,
            }),
            success: (response) => {
                console.log('Nodo actualizado:', response);
                // Opcional: informar al usuario sobre la actualización exitosa
            }
        });
    }

    addNode(padre) {
        const organigramaId = $('#chart-container').data('organigrama-id');
    
        if (!organigramaId) {
            console.error('El ID del organigrama no está definido.');
            alert('Error: El ID del organigrama no está definido.');
            return;
        }
    
        if (!padre || !padre.id) {
            console.error('El nodo padre no es válido.');
            alert('Error: El nodo padre no es válido.');
            return;
        }
    
        const nuevoNodoTempId = this.generateTempId(); // Asignar un ID temporal
    
        const nuevoNodoTemp = {
            'id': nuevoNodoTempId, // Añadir el ID temporal
            'puesto': 'Nuevo Puesto',
            'codigo': 'Nuevo Codigo',
            'foto': 'https://via.placeholder.com/80',
            'parent_id': padre.id, // Asegurarse de que es un ID real
            'organigrama_id': organigramaId,
            'children': []
        };
    
        console.log('Enviando nuevo nodo:', nuevoNodoTemp);
    
        $.ajax({
            url: '/nodos',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(nuevoNodoTemp),
            success: (data) => {
                console.log('Nodo añadido:', data);
                const parentNode = this.findNodeById(padre.id);
                if (parentNode) {
                    if (!parentNode.children) {
                        parentNode.children = [];
                    }
                    parentNode.children.push(this.transformarNodos(data)); // Transformar nodos recursivamente
                    this.refreshChart();
                    alert('Nodo añadido exitosamente.');
                } else {
                    console.error('No se encontró el nodo padre en los datos');
                    alert('Error al añadir el nodo. Nodo padre no encontrado.');
                }
            },
            error: (xhr) => {
                console.error('Error al añadir nodo:', xhr.responseText);
                alert('Error al añadir el nodo. Inténtalo de nuevo.');
            }
        });
    }

    // Eliminar un nodo
    deleteNode(node) {
        if (!confirm('¿Estás seguro de que deseas eliminar este nodo?')) {
            return;
        }

        $.ajax({
            url: '/nodos/' + node.id,
            type: 'DELETE',
            success: () => {
                const parentNode = this.findParentNode(node.id);
                if (parentNode && parentNode.children) {
                    parentNode.children = parentNode.children.filter(child => child.id !== node.id);
                }
                this.refreshChart();
                alert('Nodo eliminado exitosamente.');
            },
            error: (xhr, status, error) => {
                console.error('Error al eliminar nodo:', xhr.responseText);
                alert('Error al eliminar el nodo.');
            }
        });
    }

    // Función para encontrar el nodo padre de un nodo dado
    findParentNode(childId, node = this.data) {
        if (node.children && node.children.length > 0) {
            for (let child of node.children) {
                if (child.id === childId) {
                    return node;
                } else {
                    const result = this.findParentNode(childId, child);
                    if (result) return result;
                }
            }
        }
        return null;
    }

    // Refrescar y renderizar el organigrama
    refreshChart() {
        $('#chart-container').empty();
        this.Inicio();
    }

    // Inicializar los botones de la interfaz
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

        $('#saveDataBtn').on('click', () => this.guardarDatos()); 

        $('#toggleButtonsBtn').on('click', () => {
            $('#toggleableButtons').slideToggle();
            $('#toggleButtonsBtn').toggleClass('rotated');
            const isExpanded = $('#toggleableButtons').is(':visible');
            $('#toggleButtonsBtn').attr('aria-expanded', isExpanded);
        });
    }

    guardarDatos() {
        if (!confirm('¿Estás seguro de que deseas guardar todos los datos del organigrama? Esto sobrescribirá los datos existentes.')) {
            return;
        }

        if (!this.data || !this.data.id) {
            alert('El organigrama no contiene nodos. Por favor, añade nodos antes de guardar.');
            return;
        }

        const organigramaId = $('#chart-container').data('organigrama-id');

        const getAllNodes = (node) => {
            let nodes = [node];
            if (node.children && node.children.length > 0) {
                for (let child of node.children) {
                    nodes = nodes.concat(getAllNodes(child));
                }
            }
            return nodes;
        };

        const allNodes = getAllNodes(this.data);

        const payload = {
            'organigrama_id': organigramaId,
            'nodos': allNodes.map(node => ({
                'id': node.id, // Asegurar que 'id' está presente
                'puesto': node.puesto,
                'codigo': node.codigo,
                'foto': node.foto,
                'parent_id': node.parent_id
            }))
        };

        console.log('Estructura de los datos antes de enviarlos:', JSON.stringify(payload, null, 2));

        $.ajax({
            url: '/guardar-organigrama',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: () => {
                alert('Datos guardados exitosamente.');
                location.reload();
                this.cargarDatos();
            },
            error: (xhr) => {
                console.error('Error al guardar los datos:', xhr.responseText);
                alert('Error al guardar los datos.');
            }
        });
    }

    resetNodes() {
        if (!confirm('¿Estás seguro de que deseas reiniciar todos los nodos? Esto eliminará todos los datos actuales.')) {
            return;
        }

        this.data = {
            'id': 1,
            'puesto': 'Puesto Principal',
            'codigo': 'Ingrese Codigo',
            'foto': 'https://via.placeholder.com/80',
            'children': []
        };
        this.refreshChart();
        this.guardarDatos();
    }

    // Inicializar el manejador para la subida de fotos
    initializeUploadHandler() {
        $('#uploadPhotoInput').on('change', (e) => {
            const file = e.target.files[0];
            if (file && this.selectedNode) {
                console.log('Nodo seleccionado para subir foto:', this.selectedNode);
                // Validar tipo de archivo
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Por favor, selecciona una imagen válida (JPEG, PNG, GIF).');
                    $('#uploadPhotoInput').val('');
                    return;
                }
    
                const formData = new FormData();
                formData.append('photo', file);
    
                $.ajax({
                    url: '/upload-photo/' + this.selectedNode.id, // Cambiado de 'upload-foto' a 'upload-photo'
                    type: 'POST',
                    data: formData,
                    processData: false, // Evita que jQuery procese los datos
                    contentType: false, // Evita que jQuery establezca el Content-Type
                    beforeSend: () => {
                        console.log('Subiendo imagen...');
                    },
                    success: (response) => {
                        if (response.path) {
                            const newSrc = 'data:image/jpeg;base64,' + response.path;
                            console.log('URL de la imagen:', newSrc); // Para depuración
    
                            // Actualizar la imagen del nodo en la interfaz de usuario
                            $('img[data-id="' + this.selectedNode.id + '"]').attr('src', newSrc);
                            this.selectedNode.foto = newSrc; // Actualizar la URL de la imagen en los datos del nodo
                            console.log('Imagen actualizada correctamente para nodo ID:', this.selectedNode.id);
                        } else {
                            console.error('Respuesta inválida:', response);
                            alert('Error al subir la foto. Respuesta inválida del servidor.');
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('Error al subir la foto:', xhr.responseText);
                        alert('Error al subir la foto. Inténtalo de nuevo.');
                    },
                    complete: () => {
                        // Resetear el input para permitir subir la misma imagen nuevamente si es necesario
                        $('#uploadPhotoInput').val('');
                        console.log('Proceso de subida de imagen completado para nodo ID:', this.selectedNode.id);
                    }
                });
            } else {
                alert('Por favor, selecciona un archivo y un nodo válido.');
                // Resetear el input
                $('#uploadPhotoInput').val('');
            }
        });
    }
}

$(document).ready(() => {
    const orgChart = new OrgChart();

    $('#previewBtn').on('click', () => {
        // Ocultar el contenedor de botones y el header
        $('#buttonContainer').hide();
        $('header').hide(); 

        const original = $('#chart-container');
        const cloned = original.clone();
        cloned.attr('id', 'chart-clone').css({
            position: 'absolute',
            top: '0',                  // Alinear al inicio verticalmente
            left: '50%',               // Centrar horizontalmente
            transformOrigin: 'top center',
            transform: 'translate(-50%, 0%) scale(1)', // Centrar horizontalmente sin desplazar verticalmente
            width: 'auto',             // Permitir tamaño dinámico
            height: 'auto',
            overflow: 'visible',
            display: 'block',
            margin: '0'                 // Eliminar márgenes automáticos
        });
        $('body').append(cloned);

        // Ocultar el contenedor original para que solo el clon sea visible en la impresión
        original.hide();

        const w = cloned[0].scrollWidth;
        const h = cloned[0].scrollHeight;
        const pageW = 595, pageH = 842; // Tamaño A4 en píxeles

        // Calcular la escala necesaria para que todo el contenido quepa en una hoja A4
        const scaleWidth = pageW / w;
        const scaleHeight = pageH / h;
        const scale = Math.min(scaleWidth, scaleHeight, 1) * 0.95; // Evita escalado mayor a 1 y deja un margen

        cloned.css({
            transform: `translate(-50%, 0%) scale(${scale})`,
            overflow: 'visible' // Evitar recortes
        });

        // Activar la función de impresión
        window.print();

        // Restaurar el estado original después de la impresión
        setTimeout(() => {
            cloned.remove();
            original.show();
            $('header').show(); // Restaurar el header
            $('#buttonContainer').show();
        }, 500);
    });
});