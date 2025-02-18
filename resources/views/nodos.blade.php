<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigrama con jsOrgChart</title>
    <!-- Carga CSS y JS sin volver a instanciar la librería -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('OrgChart/jquery 2.1.0.orgchart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('JQuery-UI-1.14.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="buttonContainer">
    <button id="toggleButtonsBtn" aria-expanded="false" aria-controls="toggleableButtons">
        <i class="fas fa-cog"></i>
    </button>
    <div id="toggleableButtons" class="toggleable">
        <button id="addChildBtn"><i class="fas fa-plus"></i> Añadir Nodo</button>
        <button id="deleteNodeBtn"><i class="fas fa-trash"></i> Eliminar Nodo</button>
        <button id="resetNodesBtn"><i class="fas fa-redo"></i> Reiniciar Nodos</button>
        <button id="saveDataBtn"><i class="fas fa-save"></i> Guardar Datos</button>
        <button id="previewBtn"><i class="fas fa-save"></i> Previsualizar</button>
    </div>
    <input type="file" id="uploadPhotoInput" style="display: none;" accept="image/*">
</div>

<!-- Header con el Nombre del Organigrama -->
<header class="text-center my-4">
    <h1 class="text-3xl font-bold" id="organigramaNombre" contenteditable="true">{{ $organigrama->nombre }}</h1>
</header>

<!-- Contenedor del Organigrama -->
<div id="chart-container" data-organigrama-id="{{ $organigrama->id }}">

</div>

<!-- Carga de librerías y script.js -->
<script src="{{ asset('JQuery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('JQuery-UI-1.14.1/jquery-ui.min.js') }}"></script>
<script src="{{ asset('OrgChart/jquery 2.1.0.orgchart.min.js') }}"></script>
<script src="{{ asset('script.js') }}"></script>
<script>
     $(document).ready(function() {
        // Hacer el nombre del organigrama editable
        $('#organigramaNombre').on('blur', function() {
            var nuevoNombre = $(this).text().trim();
            if (nuevoNombre && nuevoNombre !== '{{ $organigrama->nombre }}') {
                // Enviar la actualización al servidor
                $.ajax({
                    url: '{{ route("organigramas.updateNombre", ["plan_de_negocio" => $plan_de_negocio->id, "organigrama" => $organigrama->id]) }}',
                    type: 'PUT',
                    data: {
                        nombre: nuevoNombre,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Nombre del organigrama actualizado correctamente.');
                    },
                    error: function(error) {
                        alert('Error al actualizar el nombre del organigrama. Inténtalo de nuevo.');
                    }
                });
            }
        });

        $('#organigramaNombre').on('keypress', function(e) {
            if (e.which == 13) { // Enter key pressed
                e.preventDefault();
                $(this).blur();
            }
        });
    });
</script>
</body>
</html>