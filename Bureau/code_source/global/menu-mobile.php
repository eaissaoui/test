<div id="menu">
	<?php if (!utilisateur_est_connecte()) { ?>
		<a href="index.php?module=membres&amp;action=connexion"><img src="images/login.png" alt="Connexion" /></a>
	<?php } else { ?>
		<a href="index.php?module=membres&amp;action=deconnexion"><img src="images/logout.png" alt="Déconnexion" /></a>
		<a href="index.php?module=membres&amp;action=modifier_profil"><img src="images/profil.png" alt="Mon compte" /></a>
		<a href="index.php?module=tickets&amp;action=suivi_ticket&amp;id=<?php echo $_SESSION['id'];?>"><img src="images/histo.png" alt="Suivi des tickets" /></a>
		<a href="index.php?module=tickets&amp;action=creer_ticket"><img src="images/add.png" alt="Création d'un ticket" /></a>
	<?php } ?>	
	<a href="index.php"><img src="images/home.png" alt="Accueil" /></a>
</div>