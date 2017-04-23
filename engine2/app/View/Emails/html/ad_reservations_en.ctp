<h1>Neue Reservierung:</h1>
	<br><br>
	<strong>Name: </strong>:<?php echo $data['Reservation']['Reservation']['name'];?>.<br>
	<strong>Type: </strong><?php echo $data['Reservation']['Reservation']['type'];?>.<br>
	<strong>Telefon: </strong><?php echo $data['Reservation']['Reservation']['phone'];?>.<br>
	<strong>Email: </strong><?php echo $data['Reservation']['Reservation']['email'];?>.<br>

<hr>
	<br>
		<strong>Restaurant: </strong>Thai Atrium
	<br>
<hr>
	<br>
	<strong>Datum: </strong><?php echo $data['Reservation']['Reservation']['date'];?>.<br>
	<strong>Uhrzeit: </strong><?php echo $data['Reservation']['Reservation']['time'];?>.<br>
	<strong>Anzahl Personen: </strong><?php echo $data['Reservation']['Reservation']['num_of_person'];?>.
	<br>
<hr>
	<br><br>
<strong>Sonderwuensche: </strong>
	<br>
	<?php echo $data['Reservation']['Reservation']['message'];?>