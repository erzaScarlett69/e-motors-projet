<?php
	function isLogingValid($Email, $Password)
	{
		if($Email == "henri.dupond@gmail.com" && $Password == "azerty")
		{
			return true;
		}
		return false;
	}
	
	if(isset($_POST['Email']) && isset($_POST['Password']))
	{
		if(isLogingValid($_POST['Email'], $_POST['Password']))
		{
			session_start();
			$_SESSION['log'] = $_POST['Email'];
			header('Location: admin.php');
		}
		else
		{
			header('Location: loging.php?error=1');
		}
	}
	else
	{
		header('Location: index.php?error=1');
	}
?>