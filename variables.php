<?php

// Récupération des variables à l'aide du client MySQL
$SQLclients = $mysqlClient->prepare('SELECT * FROM clients');
$SQLclients->execute();
$clients = $SQLclients->fetchAll();

