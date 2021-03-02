<?php
require 'db.php';
$db = DB::getInstance();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
</head>
<body>
    <?php
    $request = $db->prepare("SELECT lastName, firstName FROM colyseum.clients");
    $request->execute();?>
    <p>Voici la liste des clients : </p>
    <ul>
        <?php foreach ($request->fetchAll() as $clients){ ?>
            <li><p>Monsieur/Madame <?= $clients['lastName'] ?> <?= $clients['firstName'] ?></p></li>
        <?php } ?>
    </ul>
    <?php
    $request = $db->prepare("SELECT type FROM colyseum.showTypes");
    $request->execute(); ?>
    <p>Voici la liste des différents type de spectacle possible :</p>
    <ol>
    <?php foreach ($request->fetchAll() as $typeShow){ ?>
        <li><?= $typeShow['type'] ?></li>
    <?php } ?>
    </ol>

    <?php
    $request = $db->prepare("SELECT lastName, firstName FROM colyseum.clients LIMIT 20");
    $request->execute();?>
    <p>Voici la liste des 20 premiers clients inscrits : </p>
    <ul>
        <?php foreach ($request->fetchAll() as $clients){ ?>
            <li><p>Monsieur/Madame <?= $clients['lastName'] ?> <?= $clients['firstName'] ?></p></li>
        <?php } ?>
    </ul>

    <?php
    $request = $db->prepare("SELECT lastName, firstName, cardNumber FROM colyseum.clients WHERE card = TRUE");
    $request->execute();?>
    <p>Voici la liste des clients inscrits avec une carte : </p>
    <ul>
        <?php foreach ($request->fetchAll() as $clients){ ?>
            <li><p>Monsieur/Madame <?= $clients['lastName'] ?> <?= $clients['firstName'] ?> N°<?= $clients['cardNumber'] ?></p></li>
        <?php } ?>
    </ul>

    <?php
    $request = $db->prepare("SELECT lastName, firstName FROM colyseum.clients WHERE lastName LIKE 'M%' ORDER BY lastName");
    $request->execute();?>
    <p>Voici la liste des clients inscrits avec une carte : </p>
    <?php foreach ($request->fetchAll() as $clients){ ?>
        <ol>
            <li><p>Nom: <?= $clients['lastName'] ?></p></li>
            <li><p>Prénom: <?= $clients['firstName'] ?></p></li>
        </ol>
        <hr>
    <?php } ?>

    <?php
    $request = $db->prepare("SELECT title, performer, date, startTime FROM colyseum.shows");
    $request->execute();?>
    <p>Voici la liste des spectacles: </p>
    <ul>
        <?php foreach ($request->fetchAll() as $spectacle){ ?>
            <li><p><?= $spectacle['title'] ?> par <?= $spectacle['performer'] ?>, le <?= $spectacle['date'] ?> à <?= $spectacle['startTime'] ?></p></li>
        <?php } ?>
    </ul>

    <?php
    $request = $db->prepare("SELECT * FROM colyseum.clients");
    $request->execute();?>
    <p>Voici la liste des clients: </p>
    <?php foreach ($request->fetchAll() as $clients){ ?>
        <p>Nom: <?= $clients['lastName'] ?></p>
        <p>Prénom: <?= $clients['firstName'] ?></p>
        <p>Date de naissance: <?= $clients['birthDate'] ?></p>
        <p>Carte de fidélité: <?= $clients['card'] ? 'Oui' : 'Non' ?></p>
        <?php if(!empty($clients['cardNumber'])){ ?>
            <p>Numéro de la carte de fidélité: <?= $clients['cardNumber'] ?></p>
        <?php } ?>
    <?php } ?>

</body>
</html>
