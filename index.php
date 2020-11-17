<?php

use Ballen\Distical\Entities\LatLong;
use Ballen\Distical\Calculator as DistanceCalculator;

use VivaYasu\Int2Eng\Int2Eng;

require 'vendor/autoload.php';

try {
    echo '

    <!DOCTYPE html>
    <html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

        <style>
        .resultado {
            border: 2px solid black;
            padding: 10px;
            border-radius: 5px;
            background-color: #4db6ac;
            width: fit-content;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        </style>
    
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="UTF-8">
    </head>
    
    <body>
    
    
        <div class="row">
    
            <div class="col s12  blue center-align card-panel teal lighten-2">
                <h4>Examen Despliegue Aplicaciones Web</h4>
            </div>
            
            <div class="col s12  ">
                
                <p>Lo que vamos a realizar es una aplicacion en PHP, que realize lo siguiente:
                <ol>
                <li>Dado dos puntos calcular la distancia entre ellos. Esos puntos vendran marcados por su latitud y su longitud </li>
                <li>Una vez halla calculado la distancia quiero que me traduzca al ingles esa distancia.</li>
                </ol>
                </p>
                <p>
                Por ejemplo dadas las siguientes coordenadas:
                <ul>
                <li>(41.65518, -4.72372) corresponde a Valladolid </li>
                <li>(37.38283, -5.97317) corresponde a Sevilla </li>
                </ul>
                
                </p>
            
                
            </div>
            <aside>
                        <h5>Enlace Heroku </h5>
                        Pulsa sobre esta imagen para ver desplegada la aplicacion sobre heroku
                        <p>
                        <a title="Heroku" href="examendawlv92.herokuapp.com"><img src="imagenes/heroku.png" alt="Heroku" width="120" height="120" /></a>
                        </p>
            </aside>
            <form class="col s12" method = "POST">
                <div class="row">
                    
                    <div class="input-field col s2">
                        <label for="n_entero">Introduce la Latitud Punto 1:</label>
                        <input required name="punto1_latitud" type="text" class="validate">
                        
                    </div>
                    <div class="input-field col s2">
                        <label for="n_entero">Introduce la Longitud  Punto 1:</label>
                        <input required name="punto1_longitud" type="text" class="validate">
                    
                    </div>
                    <div class="input-field col s2">
                        <label for="n_entero">Introduce la Latitud Punto 2:</label>
                        <input required name="punto2_latitud" type="text" class="validate">
                    
                    </div>
                    <div class="input-field col s2">
                        <label for="n_entero">Introduce la Longitud  Punto 2:</label>
                        <input required name="punto2_longitud" type="text" class="validate">
                    
                    </div>
                   
    
                    <div class="row "></div> <!-- linea en blanco -->
                    <div class="col s4">
    
                        <button class="btn waves-effect waves-light" type="submit" name="calcular">Calcular
    
                        </button>
    
                    </div>
                    
                </div>
            </form>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
    
    </html>';

    if (isset($_REQUEST['calcular'])) {
        $punto1_latitud = $_REQUEST['punto1_latitud'];
        $punto1_longitud = $_REQUEST['punto1_longitud'];
        $punto2_latitud = $_REQUEST['punto2_latitud'];
        $punto2_longitud = $_REQUEST['punto2_longitud'];
        if (is_numeric($punto1_latitud) && is_numeric($punto1_longitud) && is_numeric($punto2_latitud) && is_numeric($punto2_longitud)) {

            $punto1 = new LatLong($punto1_latitud, $punto1_longitud);
            $punto2 = new LatLong($punto2_latitud, $punto2_longitud);

            $distanceCalculator = new DistanceCalculator($punto1, $punto2);
            $distance = $distanceCalculator->get();
            $km = $distance->asKilometres();
            $mi = $distance->asMiles();

            $int1eng = new Int2Eng((int)$km);
            $int2eng = new Int2Eng((int)$mi);
            $int1eng_ = $int1eng->get_eng();
            $int2eng_ = $int2eng->get_eng();

            echo '<p class="resultado">La distancia entre los puntos es de:<br>', $km, ' kil&oacute;metros (', $int1eng_, ')<br>', $mi, ' millas (', $int2eng_, ')</p>';
        } else {
            echo '<script type="application/javascript">setTimeout(() => {alert("Error: Los valores introducidos no son números reales");}, 100);</script>';
        }
    }
} catch (Exception $e) {
    echo '<script type="application/javascript">setTimeout(() => {alert("Exception: ', $e, '");}, 100);</script>';
}
