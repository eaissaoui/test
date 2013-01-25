<?php

if (!empty($msg_confirm)) {

	echo '<ul>'."\n";

	foreach($msg_confirm as $m) {

		echo '	<li>'.$m.'</li>'."\n";
	}

	echo '</ul><br/>';
}

if (!empty($erreurs_form_modif_mdp)) {

	echo '<ul>'."\n";

	foreach($erreurs_form_modif_mdp as $e) {

		echo '	<li>'.$e.'</li>'."\n";
	}

	echo '</ul><br/>';
}

$form_modif_mdp->fieldsets(array("Modification du mot de passe" => array('nom', 'prenom', 'adresse_email', 'mdp_ancien', 'mdp', 'mdp_verif', 'submit')));

echo $form_modif_mdp;

?>
