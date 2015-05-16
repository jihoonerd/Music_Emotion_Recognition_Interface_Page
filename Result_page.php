<!DOCTYPE php>
<html lang="en-US">
<head>
<title>Valence</title>
<meta charset="UTF-8">
</head>

<body>
<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_emotion_retrieval";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: ". $conn->connect_error);
}
//echo "MySQL Connected successfully";
//echo "<br>";

// Create MySQL TABLE for saving selected results
$sql = "CREATE TABLE IF NOT EXISTS Selected_Results (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Selected_Arousal TEXT(30) NOT NULL,
		Selected_Valence TEXT(30) NOT NULL
		)";
if ($conn->query($sql) === TRUE) {
	//echo "Table Selected_Results connected successfully";
	//echo "<br>";
} else {
	echo "Error creating table: " . $conn->error;
	echo "<br>";
}

// Insert the selected data to MySQL: Selected_Results
$sql = "INSERT INTO Selected_Results (Selected_Arousal, Selected_Valence) VALUES ('".$_SESSION["Selected_Arousal"]."', '".$_SESSION["Selected_Valence"]."')";
if ($conn->query($sql) === TRUE) {
	//echo "New RESULT data created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "<br>";

// Update the MySQL: SONG_DATA annotation
$sql = "UPDATE SONG_DATA SET annotation = annotation + 1 WHERE id = ".$_SESSION["SONG_DATA_id"]."";  
if ($conn->query($sql) === TRUE) {
	//echo "SONG_DATA updated successfully";
} else {
	echo "Error updating record: " . $conn->error;
}
$conn->close();

?>

<form action="" method="post" id="input">
<table style = "width: 50%">
	<tr>
		<td> Thank you for this contribution! </td>
	</tr>
	<tr>
		<td> 
		<input type="button" id='toMain' value="Go to main" style="float: right; width: 200px" onclick="location.href='Main.php'">
		</td>
		<td>
		<input type="button" id='exit' value="Exit" style="float: right; width: 200px" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
</body>
</html>
