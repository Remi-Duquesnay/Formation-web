<?php
if (isset($_COOKIE["vote"])) {
	$votes = $_COOKIE["vote"];
}else{
	$votes="";
} 
setcookie("gameVotes", $votes, time() + 60*60*24);
// connection to the data base.
$connDB = mysqli_connect("localhost", "virtual", "1234", "game_votes");

// check of the connection
if (!$connDB) {
	echo "Erreur de connexion : " . mysqli_connect_error();
}

// Create querry for the data
$sql = "SELECT * FROM games";
// make the quarry and get the result
$result = mysqli_query($connDB, $sql);
// fetch the result rows as an array
$games = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($connDB);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title></title>
	<?php
	include("cards.php");
	?>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="card-columns">
				<?php
				foreach ($games as $index => $value) {
					card($value["id"],$value["title"], $value["number_of_votes"], $value["total_vote_score"], $value["img_location"], $votes);
				}
				?>
			</div>
		</div>
	</div>
</body>

</html>