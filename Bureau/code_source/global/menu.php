<div id="menu">	
	<ul>
	<?php if (!utilisateur_est_connecte()) { ?>
		<li><a href="index.php?module=membres&amp;action=connexion">Connexion</a></li>
	<?php } else { ?>
		<li><a href="index.php?module=membres&amp;action=deconnexion">Déconnexion</a></li>
		<li><a href="index.php?module=membres&amp;action=modifier_profil">Mon compte</a></li>
		<li><a href="index.php?module=tickets&amp;action=suivi_ticket&amp;id=<?php echo $_SESSION['id'];?>">Suivi des tickets</a></li>
		<li><a href="index.php?module=tickets&amp;action=creer_ticket">Création d'un ticket</a></li>
	<?php } ?>	
		<li><a href="index.php">Accueil</a></li>
	</ul>
</div>
