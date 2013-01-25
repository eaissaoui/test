
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>GSB - Gestionnaire de tickets d'incident</title>
		<meta http-equiv="Content-Language" content="fr" />
		<?php
			$mobile = false;
			if (stristr($_SERVER['HTTP_USER_AGENT'], "iPhone") || strpos($_SERVER['HTTP_USER_AGENT'], "iPod") || strpos($_SERVER['HTTP_USER_AGENT'], "Android") 
				|| strpos($_SERVER['HTTP_USER_AGENT'], "iPad")|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry')) 
			{
				$mobile = true;
		?>
		<link rel="stylesheet" href="style/mobile.css" type="text/css" media="screen" />
		<?php
			}
			else
			{
		?>
		<link rel="stylesheet" href="style/global.css" type="text/css" media="screen" />
		<?php 
			}
		?>
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
	</head>
	<body>
		<div id="logo"></div>
		<div id="banniere"><h1><?php echo $titre; ?></h1></div>
		<?php 
			if ($mobile == true) include 'global/menu-mobile.php';
			else include 'global/menu.php';
		?>
		<div class="separateur">
			<?php if (utilisateur_est_connecte()) {?>
				<span id="bienvenu">Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom'].' '.$_SESSION['nom']); ?>. Si vous n'êtes pas <?php echo htmlspecialchars($_SESSION['prenom'].' '.$_SESSION['nom']); ?>, <a href="index.php?module=membres&amp;action=deconnexion">déconnectez-vous</a>.</span>
			<?php } ?>
		</div>
		<div id="centre">

