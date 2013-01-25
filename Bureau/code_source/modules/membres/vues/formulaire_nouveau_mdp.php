<?php
$titre = 'Réinitialisation du mot de passe';

if (!empty($erreurs_nouveau_mdp)) {

	echo '<ul>'."\n";
	
	foreach($erreurs_nouveau_mdp as $e) {
	
		echo '	<li>'.$e.'</li>'."\n";
	}
	
	echo '</ul><br/>';
}

$form_nouveau_mdp->fieldsets(array("Récupération de mot de passe" => array('newpass', 'confirmnewpass', 'submit')));

echo $form_nouveau_mdp;
?>
