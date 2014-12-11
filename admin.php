<?php
	session_start();
	if(!(isset($_SESSION['log'])))
	{
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
            Connexion reussie<br />
		</p>
	</div>
	</body>
</html>