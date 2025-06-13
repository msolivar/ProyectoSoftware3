<?php

    require_once('conexionbd.php');



    // $tabla = "boleto";

    // require_once(dirrecursos .'descripciondelatabla.php');  // Mostrar La Descripcion De La Tabla



    $consulta = "

    SELECT *, 

    CONCAT(

        CASE DAYOFWEEK(fechaIngreso)

            WHEN 1 THEN 'Domingo'

            WHEN 2 THEN 'Lunes'

            WHEN 3 THEN 'Martes'

            WHEN 4 THEN 'Miércoles'

            WHEN 5 THEN 'Jueves'

            WHEN 6 THEN 'Viernes'

            WHEN 7 THEN 'Sábado'

        END, ' ',

        DATE_FORMAT(fechaIngreso, '%e de %M')

    ) AS fechaEvento,

    DATE_FORMAT(fechaIngreso, '%l:%i %p') AS horaIngresoEvento

    FROM boleto 

    WHERE id > 1

    ";

    $qry = $conexion->query($consulta);

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

            color: black;

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

            width: 70px;  /* Ancho */

            height: 70px; /* Alto */

        }

    </style>

</head>

<body>

    <center>

        <div class="container text-center mt-4">  

            <div class="header-container" style="width: 520px;margin-left: 150px;">   

                <h1>BIENVENIDO</h1>

                <h2>AL PARQUE DE LA VIDA</h2>

                <b><?=$fecha_colombia?></b>

                <p>"Descubre un oasis natural donde la fauna y la flora se encuentran en armonía.<br>

                Explora senderos mágicos y conoce especies fascinantes."</p>

            </div>

        

            <div class="header-container" style="width: 220px;">

                <img src="recursos\koala.jpg" alt="Koala">

                <a href="entrada.php?&entrada=1" class="btn-entrada">Entradas Aquí</a>

            </div>

        </div>    



        <div class="container mt-5" style="display: inline-block;text max-width: 920px;background-color: gray;">

            <h3>EVENTOS</h3>

            <div class="row mt-4">



            <?php

                while ($row = $qry->fetch_array(MYSQLI_ASSOC)) {

                    $evento = empty($row['evento']) ? "Null" : $row['evento'];

                    $imagenEvento = empty($row['imagenEvento']) ? "Null" : $row['imagenEvento'];

                    $fechaEvento = empty($row['fechaEvento']) ? "Null" : $row['fechaEvento'];

                    $horaIngresoEvento = empty($row['horaIngresoEvento']) ? "Null" : $row['horaIngresoEvento'];

                    $entrada = empty($row['id']) ? "Null" : $row['id']; 

            ?>

            

                <div class='col-md-3'>

                    <div class='event-card'>

                        <img src="<?=$imagenEvento?>" class="imagenes" alt="<?=$evento?>">

                        <h5><?=$evento?></h5>

                        <b>Fecha Ingreso:</b>

                        <p><?=$fechaEvento?></p>

                        <b>Hora Entrada:</b>

                        <p><?=$horaIngresoEvento?></p>

                        <!-- <button type="submit">Comprar Entrada</button> -->

                        <a class="btn-comprar" href="entrada.php?&entrada=<?=$entrada?>">

                            Comprar Entrada

                        </a>

                    </div>

                </div>

            <?php        

                }

            ?>

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