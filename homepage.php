<?php
include 'connection.php';

//$query="SELECT date,color,item FROM jersey WHERE date = '" . $date . "' AND item = 'Jersey';";

$sql = <<<SQL
	SELECT a.game_ID, a.date, a.time, b.location as awayloc, b.name as awayname, c.location as homeloc, c.name as homename, a.over_under, a.spread, d.location, a.moneyline_away, a.moneyline_home
	FROM game_detail a
	INNER JOIN team b
	ON a.team_ID_away = b.team_ID
	INNER JOIN team c
	ON a.team_ID_home = c.team_ID
	INNER JOIN team d
	ON a.spread_team_ID = d.team_ID
SQL;

if(!$result = $conn->query($sql)){
    die('There was an error running the query [' . $conn->error . ']');
}

?>
<html>
<head>
    <title>Homepage</title>
</head>
<body>
    <?php 

while($row = $result->fetch_assoc()){
    echo 
	'<table border="1"><tr><td>Date</td><td>' . $row["date"] . '</td><td>'. $row["time"] . '</td></tr>
	<tr><td>Away</td><td>'. $row["awayloc"] . '</td><td>'. $row["awayname"]  . '</td></tr>
	<tr><td>Home</td><td>'. $row["homeloc"] . '</td><td>' . $row["homename"] . '</td></tr>
	<tr><td>Over Under</td><td>'. $row["over_under"] . '</td><td></td></tr>
	<tr><td>Spread</td><td>'. $row["spread"] . '</td><td>'. $row["location"] . '</td></tr>
	<tr><td>Moneyline</td><td>'. $row["awayloc"] . '</td><td>'. $row["moneyline_away"]  . '</td></tr>
	<tr><td></td><td>'. $row["homeloc"] . '</td><td>'. $row["moneyline_home"]  . '</td></tr>
	<tr><td></td><td></td><td>
	
	<form method="post" action="pick.php">
		<input type="hidden" name="game_ID" value="'. $row["game_ID"] .'">
		<input type="submit" value="Pick this Game">
	</form>
	
	</td></tr>
	<tr><td><br/><br/></td></tr> </table>';
}
echo 'Total results: ' . $result->num_rows;

$conn->close();
	?>
</body>
</html>