<?php
$titre = 'Réinitialisation du mot de passe';

if (!empty($erreurs_mdp_oublie)) {

	echo '<ul>'."\n";
	
	foreach($erreurs_mdp_oublie as $e) {
	
		echo '	<li>'.$e.'</li>'."\n";
	}
	
	echo '</ul><br/>';
}

$form_mdp_oublie->fieldsets(array("Récupération de mot de passe" => array('mail', 'submit')));

echo $form_mdp_oublie;
?>
