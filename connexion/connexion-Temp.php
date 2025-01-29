<?php

try {
    session_start();
    $connexion = new PDO('mysql:dbname=eka_manager;host=localhost', 'root', '');
} catch (Exception $e) {
    echo $e;
}

