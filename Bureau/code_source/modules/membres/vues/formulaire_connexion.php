<?php

if (!empty($erreurs_connexion)) {

	echo '<ul>'."\n";
	
	foreach($erreurs_connexion as $e) {
	
		echo '	<li>'.$e.'</li>'."\n";
	}
	
	echo '</ul><br/>';
}

$form_connexion->fieldsets(array("Identification" => array('email', 'mot_de_passe', 'submit')));

echo $form_connexion;
echo '<div id="mdpoublie"><a href="index.php?module=membres&amp;action=mdp_oublie">Mot de passe oublié ?</a></div>';

?>
