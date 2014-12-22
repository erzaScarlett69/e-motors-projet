<?php
session_start();
if (!(isset($_SESSION['log']))) {
    header('Location: index.php');
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=tn09', 'root', '');
} 
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

//Récupération des variables envoyées par l'administrateur
$action = $_POST['action'] ;
$id = $_POST["id"];
//echo $_POST["action"];
//echo "</br>";
//echo $_POST["id"];
//echo "</br>";

//Passage de l'annonce choisi en mode non visible
if($action == 'non') {
//    echo "</br>";
//    echo "UPDATE vehicule SET Visible = 0 WHERE id =".$id;
//    echo "</br>";
    $bdd->query("UPDATE vehicule SET Visible = 0 WHERE id =".$id);
//    echo "</br>";
}
//Passage de l'annonce choisi en mode visible
elseif ($action == 'oui') {
//    echo "</br>";
//    echo "UPDATE vehicule SET Visible = 1 WHERE id =".$id;
//    echo "</br>";
    $bdd->query("UPDATE vehicule SET Visible = 1 WHERE id =".$id);
//    echo "</br>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test technique - Modification</title>
    </head>

    <h2>Modification effectuÃ©e</h2>

        <!--Permet le retour sur la page administrateur-->
        Retour page Admin <a href="admin.php">clique ici</a>
</html>

