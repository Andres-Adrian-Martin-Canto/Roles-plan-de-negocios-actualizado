<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $estudio->nombre }}</title>

</head>
<body>
    <table style="width: 100%;">
        <tr>
        <td style="text-align: center; vertical-align: middle;">
            <h1 style="font-size: 20px; color: #333;">Plan de negocio: {{ $plan_de_negocio->nombre }}</h1>
            @if ($plan_de_negocio->imagenes_corporativas != null)
                <img src="{{ $plan_de_negocio->imagenes_corporativas->logotipo }}" alt="Logo de la página" style="width: 100px; height: auto;">
            @else
            <div style="background-color: #f2f2f2; padding: 10px;">
                <p style="color: #888; font-size: 18px;">Sin logotipo</p>
            </div>
            @endif
            <h1 style="font-size: 18px; color: #333;">Estudio de mercado: {{ $estudio->nombre }}</h1>
        </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr>
        <td style="text-align: left; vertical-align: middle;">
            <h1 style="font-size: 16px; color: #333;">1.- Objetivo del estudio de mercado</h1>
            <h1 style="font-size: 15px; color: #333; font-weight: normal;">{{ $estudio->objetivo }}</h1>

            <h1 style="font-size: 16px; color: #333;">2.- Objetivos específicos del estudio de mercado</h1>
            <h1 style="font-size: 15px; color: #333; font-weight: normal;">{{ $estudio->objetivos_especificos }}</h1>

            <h1 style="font-size: 16px; color: #333;">3.- Especificación del mercado</h1>
            <h1 style="font-size: 15px; color: #333; font-weight: normal;">{{ $estudio->especificacion }}</h1>
        </td>
        </tr>
    </table>


    <div>
        <table class="tabla_encuestas" style="margin-bottom: 30px;">
            <thead style="background-color: teal;">
                <tr class="titulo_encuestas">
                    <th scope="col" style="color: white;">Concepto</th>
                    <th scope="col" style="color: white;">Respuesta al concepto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudio->conceptos as $concepto)
                    <tr>
                        <td scope="row">{{ $concepto->concepto }}</th>
                        <td scope="row">{{ $concepto->conclusion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div>
        <table class="tabla_encuestas">
            <thead style="background-color: teal;">
                <tr class="titulo_encuestas">
                    <th scope="col" style="color: white;">Nombre de la encuesta</th>
                    <th scope="col" style="color: white;"> Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudio->encuestas as $encuesta)
                    <tr>
                        <td scope="row">{{ $encuesta->titulo }}</th>
                        <td scope="row">{{ $encuesta->descripcion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <table style="width: 100%;">
        <tr>
        <td style="text-align: center; vertical-align: middle;">
            <h1 style="font-size: 16px; color: #333;">Conclusión del estudio de mercado</h1>
            @if ($estudio->conclusion != null)
                <h1 style="font-size: 15px; color: #333; font-weight: normal; text-align: justify;">{{ $estudio->conclusion->conclusion }}</h1>
            @else
                <div style="background-color: #f2f2f2; padding: 10px;">
                    <p style="color: #888; font-size: 18px;">Aún no tienes una conclusión</p>
                </div> 
            @endif    
        </td>
        </tr>
    </table>

</body>
</html>

<style>
    body {
      font-family: "Trebuchet MS", Verdana, sans-serif;
      font-size: 12pt;
    }
    .tabla_encuestas {
    table-layout: fixed;
    width: 100%;
    border-collapse: collapse;
    border: 3px solid #D3D3D3;
    }

    thead th:nth-child(1) {
    width: 30%;
    }

    thead th:nth-child(2) {
    width: 20%;
    }

    thead th:nth-child(3) {
    width: 15%;
    }

    thead th:nth-child(4) {
    width: 35%;
    }

    th, td {
    padding: 15px;
    }

</style>