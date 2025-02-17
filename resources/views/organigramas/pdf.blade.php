
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organigrama PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
        }
        .node {
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }
        #chart-container {
            position: relative;
            width: 95%;
            height: calc(100vh - 60px);
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            background-color: #fff;
        }
        .nodo-info {
            text-align: center;
        }
        .nodo-puesto {
            font-weight: bold;
        }
        .nodo-departamento {
            font-size: 12px;
            color: #555;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .node {
            max-width: 200px;
            overflow: hidden;
            text-align: center;
            display: flex;
            margin: 20px;
            flex-direction: column;
            background-color: #c6c6c6;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('OrgChart/jquery 2.1.0.orgchart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('JQuery-UI-1.14.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
</head>
<body>
    <div class="container">
        <div class="title">{{ $organigrama->nombre }}</div>
        <div id="chart-container">
            <!-- Aquí puedes incluir el contenido del chart-container -->
            {!! $chartHtml !!}
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('OrgChart/jquery 2.1.0.orgchart.min.js') }}"></script>
    <script src="{{ asset('JQuery-UI-1.14.1/jquery-ui.min.js') }}"></script>
    <script>
        $(function() {
            $('#chart-container').orgchart({
                'data' : {!! json_encode($organigrama->toArray()) !!},
                'nodeContent': 'title'
            });
        });
    </script>
</body>
</html>