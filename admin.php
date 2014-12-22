<!--Test permettant de retourner sur la page d'index si l'on ne rentre pas les login-->
<?php
session_start();
if (!(isset($_SESSION['log']))) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test technique - Administrateur</title>
    </head>

    <body>

        <div id="corps">
            <h1>Interface administrateur</h1>

            <p>
                Bienvenue sur votre comptre administrateur<br />
                
                <?php
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=tn09', 'root', '');
                } 
                catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                
                function afficherVoiture($donnees) {
                    echo "<p>";
                    echo "<strong>Annonce</strong> : " . $donnees['Marque'] . " " . $donnees['Modele'] . " <br /> " . $donnees['Description'];
                    echo " "; 
                    afficherType($donnees);
                    echo "</br>";
                }
            
                function afficherType($donnees) {
                    if ($donnees['Type'] == 'vn') {
                        echo "Voiture neuve";
                    } elseif ($donnees['Type'] == 'vo') {
                        echo "Voiture d'occasion";
                    } else {
                        echo "Véhicule utilitaire";
                    }
                }
                
                //Affichage de la liste compl�te des annonces
                $reponse = $bdd->query('SELECT * FROM vehicule WHERE 1 ORDER BY id');
                while ($donnees = $reponse->fetch()) {
                    afficherVoiture($donnees);
                    //Affichage d'une question en dessous de chaque annonce pour la visibilit� par les utilisateurs
                    echo "Voulez-vous afficher cette annonce ?";
                    //Affichage de 2 boutons radio (oui par d�faut) et d'un bouton pour permettre la modification
                    //Renvoi vers la page modification.php
                    //Envoi la r�ponse de l'administrateur (oui ou non) et l'id de l'annonce � modifier
                    echo "<form name='modification' action='modification.php' method='POST'>
                                <input type='hidden' name='id' value=".$donnees['id']."</input>
                                <td>oui</td>
                                <td><input type='radio' name='action' value='oui' id='oui' checked='checked'></td>
                                <td>non</td>
                                <td><input type='radio' name='action' value='non' id='non'></td>
                                <td colspan='2'><input type='submit' value='Modifier'></td>
                            </form>";
                }
                $reponse->closeCursor();
                ?>
            </p>
        </div>
    </body>
</html>