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
			
			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=tn09', 'root', '');
			}
			catch(Exception $e)
			{
					die('Erreur : '.$e->getMessage());
			}
			?>
			
			<form action="index.php">
				<select name="Marque">
				<?php
				$reponse = $bdd->query('SELECT DISTINCT Marque FROM vehicule WHERE 1');
				while ($donnees = $reponse->fetch())
				{
				?>
					<option value="<?php echo $donnees['Marque']?>"><?php echo $donnees['Marque']?></option>
					<?php
					}
					$reponse->closeCursor();
					?>
				</select>
				<input type="hidden" name="action" value="recherche">
				<input type="submit" value="Rechercher">
			</form>
			
			<form action="index.php">
				<select name="Type">
				<?php
					$reponse = $bdd->query('SELECT DISTINCT Type FROM vehicule WHERE 1');
					while ($donnees = $reponse->fetch())
					{
				?>
					<option value="<?php echo $donnees['Type']?>"><?php afficherType($donnees)?></option>
				<?php
					}
					$reponse->closeCursor();
				?>
				</select>
				<input type="hidden" name="action" value="recherche">
				<input type="submit" value="Rechercher">
			</form>
			
			<form action="index.php">
				<select name="Tri">
				<option value="Prix"> Prix</option>
				<option value="Marque"> Marque</option>
				</select>
				<input type="hidden" name="action" value="tri">
				<input type="submit" value="Trier">
			</form>
			
			<?php
			function afficherVoiture($donnees)
			{
				echo "<p>";
				echo "<strong>Annonce</strong> : ".$donnees['Marque']." ".$donnees['Modele']." <br /> ".$donnees['Description']; 
				afficherType($donnees);
				echo "</em>";
				echo "</p>";
			}
			?>
			
			<?php
			function afficherType($donnees)
			{
				if($donnees['Type'] == 'vn')
				{
					echo "Voiture neuve";
				}
				elseif($donnees['Type'] == 'vo')
				{
					echo "Voiture d'occasion";
				}
				else
				{
					echo "Véhicule utilitaire";
				}
			}
			?>
			
			<?php
			if(!isset($_GET['Page']))
			{
				$Page = 0;
			}
			else
			{
				$Page = $_GET['Page'];
			}
			$start = $Page*10;
			
			if(isset($_GET['action']) && $_GET['action'] == 'recherche')
			{
				echo "<h3>Resultat de votre recherche</h3>";
				$query = 'SELECT * FROM vehicule WHERE ';
				if(isset($_GET['Marque']))
				{
					$query .= 'Marque = \''.$_GET['Marque'].'\'';
				}
				elseif(isset($_GET['Type']))
				{
					$query .= 'Type = \''.$_GET['Type'].'\'';
				}
				$reponse = $bdd->query($query);
				while ($donnees = $reponse->fetch())
				{
					afficherVoiture($donnees);
				}
				$reponse->closeCursor();
			}
			elseif(isset($_GET['action']) && $_GET['action'] == 'tri')
			{
				echo "<h3>Resultat du tri</h3>";
				if($_GET['Tri'] == "Marque")
				{
					$reponse = $bdd->query('SELECT * FROM vehicule WHERE 1 ORDER BY Marque');
				}
				elseif($_GET['Tri'] == "Prix")
				{
					$reponse = $bdd->query('SELECT * FROM vehicule WHERE 1 ORDER BY PrixTTC DESC');
				}
				while ($donnees = $reponse->fetch())
				{
					afficherVoiture($donnees);
				}
				$reponse->closeCursor();
			}	
			else
			{
				$reponse = $bdd->query('SELECT * FROM vehicule ORDER BY id LIMIT '.$start.', 10');
				while ($donnees = $reponse->fetch())
				{
					afficherVoiture($donnees);
				}
				$reponse->closeCursor();
			}
			?>
        </p>
    </div>
    
    </body>
</html>