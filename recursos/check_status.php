<?php
$id = $_GET['id'] ?? null;

if ($id && file_exists("qr_logs/$id.txt")) {
    echo "leido";
} else {
    echo "pendiente";
}