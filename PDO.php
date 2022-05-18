<?php
    try
    {
        $bdd = new PDO("mysql:host=localhost:8889;dbname=shiba_db", 'root', 'root');
    }catch(Exception $e)
    {
        die('Erreur'.$e->getMessage());
    }