<?php
    include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parque de la Vida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #2d4739;
            color: white;
        }
        .event-card {
            background: rgba(255, 255, 255, .2);
            color: black;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }
        .btn-entrada {
            background-color: #a3c57d;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            /* display: block; */
            width: fit-content;
            /* margin: 10px auto; */
        }
        .btn-comprar {
            background-color: #c4a460;
            color: white;
            padding: 10px;
            border-radius: 20px;
            text-decoration: none;
            /* display: block; */
            text-align: center;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            /* gap: 20px; */
            flex-direction: column;
            float: left;
        }
        .header-container img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
        }
        h3 {
            text-align: center;
        }
        img.imagenes {
            width:170px; /* Ancho */
            height:120px; /* Alto */
        }
    </style>
</head>
<body>
    <center>
        <div class="container text-center mt-4">  
            <div class="header-container" style="width: 520px;margin-left: 150px;">   
                <h1>BIENVENIDO</h1>
                <h2>AL PARQUE DE LA VIDA</h2>
                <p>"Descubre un oasis natural donde la fauna y la flora se encuentran en armonía.<br>
                Explora senderos mágicos y conoce especies fascinantes."</p>
            </div>
        
            <div class="header-container" style="width: 220px;">
                <img src="recursos\koala.jpg" alt="Koala">
                <a href="entrada.php" class="btn-entrada">Entradas Aquí</a>
            </div>
        </div>    

        <div class="container mt-5" style="display: inline-block;text max-width: 920px;background-color: gray;">
            <h3>EVENTOS</h3>
            <div class="row mt-4">
                <div class='col-md-3'>
                    <div class='event-card'>
                        <img src="recursos\mitoYLeyendas.png" class="imagenes" alt="Koala">
                        <h5>Mitos y Leyendas</h5>
                        <p>Sábado 23 de marzo</p>
                        <p>7:00 PM</p>
                        <!-- <button type="submit">Comprar Entrada</button> -->
                        <a class="btn-comprar" href="entrada.php?&entrada=1">
                            Comprar Entrada
                        </a>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='event-card'>
                        <img src="recursos\caminataNocturna.png" class="imagenes" alt="Koala">
                        <h5>Caminata Nocturna</h5>
                        <p>Sábado 23 de marzo</p>
                        <p>7:00 PM</p>
                        <a class="btn-comprar" href="entrada.php?&entrada=2">
                            Comprar Entrada
                        </a>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='event-card'>
                        <img src="recursos\avistamientoAves.png" class="imagenes" alt="Koala">
                        <h5>Avistamiento de Aves</h5>
                        <p>Sábado 23 de marzo</p>
                        <p>7:00 PM</p>
                        <a class="btn-comprar" href="entrada.php?&entrada=3">
                            Comprar Entrada
                        </a>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class='event-card'>
                        <img src="recursos\danzaMusica.png" class="imagenes" alt="Koala">
                        <h5>Danza y Música</h5>
                        <p>Sábado 23 de marzo</p>
                        <p>7:00 PM</p>
                        <a class="btn-comprar" href="entrada.php?&entrada=4">
                            Comprar Entrada
                        </a>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </center>
    <div class="container text-center mt-5">
        <p>Estamos ubicados en Avenida Bolívar, Calle 8 Norte</p>
        <p>Horario: Lunes a Domingo, 8:00 AM - 10:00 PM</p>
    </div>
</body>
</html>