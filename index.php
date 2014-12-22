<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test technique - Utilisateur</title>
    </head>

    <header>
        <form method="POST" action="loging.php">
            <input id="name" type="text" name="Email" placeholder="Email">
            <input id="password" type="password" name="Password" placeholder="Password">
            <input type="submit" name="connection" value="Connection">
        </form>
    </header>

    <body>

        <div id="corps">
            <h1>Interface utilisateur</h1>

            <p>
                Bienvenue sur e-motors !<br />

                <!--Importation de la base de données-->
                <?php
                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=tn09', 'root', '');
                } 
                catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }
                ?>

            <!--Création du menu déroulant pour la recherche par Marque-->
            <form action="index.php">
                <select name="Marque">
                    <?php
                    //Récupération de toutes les Marques différentes pour la liste
                    $reponse = $bdd->query('SELECT DISTINCT Marque FROM vehicule WHERE 1');
                    while ($donnees = $reponse->fetch()) {
                        ?>
                        <!--Ajout de toutes les Marques différentes pour la liste-->
                        <option value="<?php echo $donnees['Marque'] ?>"><?php echo $donnees['Marque'] ?></option>
                        <?php
                    }
                    $reponse->closeCursor();
                    ?>
                </select>
                <input type="hidden" name="action" value="recherche">
                <input type="submit" value="Rechercher">
            </form>

            <!--Création du menu déroulant pour la recherche par Type-->
            <form action="index.php">
                <select name="Type">
                    <?php
                    $reponse = $bdd->query('SELECT DISTINCT Type FROM vehicule WHERE 1');
                    while ($donnees = $reponse->fetch()) {
                        ?>
                        <option value="<?php echo $donnees['Type'] ?>"><?php afficherType($donnees) ?></option>
                        <?php
                    }
                    $reponse->closeCursor();
                    ?>
                </select>
                <input type="hidden" name="action" value="recherche">
                <input type="submit" value="Rechercher">
            </form>

            <!--Création du menu déroulant pour le tri par prix-->
            <form action="index.php">
                <select name="Tri">
                    <option value="Prix"> Prix</option>
                    <option value="Marque"> Marque</option>
                </select>
                <input type="hidden" name="action" value="tri">
                <input type="submit" value="Trier">
            </form>

            <!--Fonction permettant l'affichage de toutes les voitures en fonction de leur visibilité-->
            <?php
                function afficherVoiture($donnees) {
                    if ($donnees['Visible']) {
                        echo "<p>";
                        echo "<strong>Annonce</strong> : " . $donnees['Marque'] . " " . $donnees['Modele'] . " <br /> " . $donnees['Description'];
                        echo " "; 
                        //Appele de la méthode permettant l'affichage des types de véhicule
                        afficherType($donnees);
                        echo "</br>";
                    }
                }
            ?>

            <!--Fonction permettant l'affichage clair des différents types de véhicule-->
            <?php
            function afficherType($donnees) {
                if ($donnees['Type'] == 'vn') {
                    echo "Voiture neuve";
                } elseif ($donnees['Type'] == 'vo') {
                    echo "Voiture d'occasion";
                } else {
                    echo "VÃ©hicule utilitaire";
                }
            }
            ?>

            <?php
            //Petite boucle permettant de n'afficher que 10 véhicules par page au maximun
            if (!isset($_GET['Page'])) {
                $Page = 0;
            } 
            else {
                $Page = $_GET['Page'];
            }
            $start = $Page * 10;

            //Affichage de la recherche par Marque ou par Type
            if (isset($_GET['action']) && $_GET['action'] == 'recherche') {
                echo "<h3>Resultat de votre recherche</h3>";
                //Décomposition de la requète d'affichage pour simplifier le traitement
                $query = 'SELECT * FROM vehicule WHERE ';
                //si on a choisi l'affichage par Marque
                if (isset($_GET['Marque'])) {
                    $query .= 'Marque = \'' . $_GET['Marque'] . '\'';
                }
                //ou l'affichage par Type
                elseif (isset($_GET['Type'])) {
                    $query .= 'Type = \'' . $_GET['Type'] . '\'';
                }
                //Affichage une par une des annonces souhaitées
                $reponse = $bdd->query($query);
                while ($donnees = $reponse->fetch()) {
                    afficherVoiture($donnees);
                }
                $reponse->closeCursor();
            }
            //Affichage du tri par PrixTTC ou par Marque
            elseif (isset($_GET['action']) && $_GET['action'] == 'tri') {
                echo "<h3>Resultat du tri</h3>";
                if ($_GET['Tri'] == "Marque") {
                    $reponse = $bdd->query('SELECT * FROM vehicule WHERE 1 ORDER BY Marque');
                } 
                elseif ($_GET['Tri'] == "Prix") {
                    $reponse = $bdd->query('SELECT * FROM vehicule WHERE 1 ORDER BY PrixTTC DESC');
                }
                while ($donnees = $reponse->fetch()) {
                    afficherVoiture($donnees);
                    echo $donnees['PrixTTC'];
                    echo " euros";
                }
                $reponse->closeCursor();
            }
            //A l'ouverture, on affiche toutes les annonces visibles par l'utilisateur
            else {
                //Gràce à la condition définie plus haut, on limite à 10 annonces par page
                $reponse = $bdd->query('SELECT * FROM vehicule ORDER BY id LIMIT ' . $start . ', 10');
                while ($donnees = $reponse->fetch()) {
                    afficherVoiture($donnees);
                }
                $reponse->closeCursor();
            }
            ?>
            </p>
        </div>
    </body>
    
    <!--Création d'un menu déroulant pour choisir la page à afficher-->
    <footer >
        <form action="index.php">
            <input type="submit" value="Aller a"></input>
            <select name="Page">
                    <option value="0"> Page 1</option>
                    <option value="1"> Page 2</option>
                    <option value="2"> Page 3</option>
            </select>
        </form>
    </footer>
</html>