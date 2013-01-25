<?php

if (!empty($erreurs_creation)) {

	echo '<ul>'."\n";
	
	foreach($erreurs_creation as $e) {
	
		echo '	<li>'.$e.'</li>'."\n";
	}
	
	echo '</ul>';
}

$form_ticket->fieldsets(array("Création d'un ticket d'incident" => array('titre', 'contenu', 'categorie', 'priorite',  'date','submit')));
echo $form_ticket;

?>
