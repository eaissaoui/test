<h2>Détails du ticket d'incident n°<?php echo $monTicket->getId(); ?></h2>

<?php
	$afficher_ticket->fieldsets(array("Informations sur votre ticket d'incident" => array('id', 'titre', 'contenu',  'date', 'categorie', 'priorite')));
	echo $afficher_ticket;
?>

<h2> Etat d'avancement du traitement </h2>
<table id="statuts">
<?php
	foreach ($histo_statuts as $statut)
	{
?>
		<tr>
			<td><?php echo $statut['date_etat'];?></td>
			<td><?php echo $statut['nom_etat'];?></td>
		</tr> 
<?php	
	}
?>
</table>
