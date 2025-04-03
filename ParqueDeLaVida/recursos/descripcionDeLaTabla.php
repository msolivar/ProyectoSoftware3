<?php
  $consultaCamposTabla = "SHOW COLUMNS FROM " . $tabla;
  $qry = $conexion->query($consultaCamposTabla);

  echo "<table border='1' bgcolor='#F1F1F1'>";
  echo "<tr>
          <th>Descripcion De La Tabla " . $tabla . "</th>
        </tr>";

  $campos = "";
  $tipos  = "";
  $nulls = "";
  $keys = "";
  $valorDefaults = "";
  $extras = "";

  while ($row = $qry->fetch_array(MYSQLI_ASSOC)) {
    $campo = empty($row['Field']) ? "Null" : $row['Field'];
    $tipo = empty($row['Type']) ? "Null" : $row['Type'];
    $null = empty($row['Null']) ? "Null" : $row['Null'];
    $key = empty($row['Key']) ? "Null" : $row['Key'];
    $valorDefault = empty($row['Default']) ? "Null" : $row['Default'];
    $extra = empty($row['Extra']) ? "Null" : $row['Extra'];

    $campos .= $campo . ", ";
    $tipos .= $tipo . ", ";
    $nulls .= $null . ", ";
    $keys .= $key . ", ";
    $valorDefaults .= $valorDefault . ", ";
    $extras .= $extra . ", ";
  }

  echo "
        <tr>
          <td>Campos: {$campos}</td>
        </tr>
        <tr>
          <td>Tipos: {$tipos}</td>
        </tr>
        <tr>
          <td>Vacios: {$nulls}</td>
        </tr>
        <tr>
          <td>Keys: {$keys}</td>
        </tr>
        <tr>
          <td>ValorDefaults: {$valorDefaults}</td>
        </tr>
        <tr>
          <td>Extras: {$extras}</td>
        </tr>";
  echo "</table>";
?>