<table>
	<tr>
		<th>Numéro du ticket</th>
		<th>Titre du ticket</th>
		<th>Date de création du ticket</th>
		<th>Statut du ticket</th>
		<th></th>
	</tr>
<?php
	foreach ($histo_tickets as $ticket)
	{
?>
		<tr>
			<td><?php echo $ticket->getId();?></td>
			<td><?php echo $ticket->getTitre();?></td>
			<td><?php echo $ticket->getDate();?></td>
			<td><?php echo $ticket->getStatut();?></td>
			<td><a href=# onclick="$('#details').load('modules/tickets/afficher_ticket.php?id=<?php echo $ticket->getId(); ?>&amp;module=tickets');">Détails</a></td>
		</tr>
<?php
	}
?>
</table>

<div id="details"></div>