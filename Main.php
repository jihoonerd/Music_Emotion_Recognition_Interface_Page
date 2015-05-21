<!DOCTYPE html>
<html lang="en-US">

<!-- 
		Main Page explains meanings of arousal and valence by using a arousal-valence plane figure and sample songs.
		This page gets data from MySQL and prepares SESSIONs for storing data. 		
-->


<head>
<title>Arousal and Valence</title>
<meta charset="UTF-8">
</head>

<!--
		Connect to SQL 
-->
<?php
session_start();

// MySQL Data
$servername = "localhost";
$username = "root";
$password = "";
$_SESSION["Selected_Arousal"] = "NA"; // variable for storing collected higher arousal
$_SESSION["Selected_Valence"] = "NA"; // variable for storing collected higher valence
$dbname = "music_emotion_retrieval";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: ". $conn->connect_error);
}


/***********************************************************************************************
 *		This table is created for Demo. For practical service, MySQL should get data directly  *
 *		from the database table, which already contains the songs list. 					   *
 ***********************************************************************************************
 */

// Creating Table
$sql = "CREATE TABLE IF NOT EXISTS SONG_DATA (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		song_1 TEXT(30) NOT NULL,
		song_2 TEXT(30) NOT NULL,
		annotation INT(6) NOT NULL
		)";

if ($conn->query($sql) == TRUE) {
	//echo "Table SONG_DATA connected successfully";
	//echo "<br>";
} else {
	echo "Error creating table: " . $conn->error;
	echo "<br>";
}

//	Insert Initial Dataset to MySQL
$sql = "INSERT INTO SONG_DATA(song_1,song_2,annotation)
			SELECT 'Sample1.mp3','Sample2.mp3',0 FROM DUAL
		WHERE NOT EXISTS
			(SELECT song_1 AND song_2 FROM SONG_DATA WHERE song_1='Sample1.mp3' AND song_2='Sample2.mp3')";
$conn->query($sql);


$sql = "INSERT INTO SONG_DATA(song_1,song_2,annotation)
			SELECT 'Sample3.mp3','Sample4.mp3',0 FROM DUAL
		WHERE NOT EXISTS
			(SELECT song_1 AND song_2 FROM SONG_DATA WHERE song_1='Sample3.mp3' AND song_2='Sample4.mp3')";
$conn->query($sql);

$sql = "INSERT INTO SONG_DATA(song_1,song_2,annotation)
			SELECT 'Sample5.mp3','Sample6.mp3',0 FROM DUAL
		WHERE NOT EXISTS
			(SELECT song_1 AND song_2 FROM SONG_DATA WHERE song_1='Sample5.mp3' AND song_2='Sample6.mp3')";
$conn->query($sql);
//*********************************************************************************************************

/*
 * 		It assumes there are 4 columns in table.
 * 		ID | SONG1 | SONG2 | ANNOTATION 
 * 		It load the pair of the least annotated.
 */

// Load data (the least annotated data)
$sql = "SELECT id, song_1, song_2, annotation FROM SONG_DATA ORDER BY annotation";
$get_data = $conn->query($sql);
$recent = $get_data->fetch_assoc();
$_SESSION["SONG_DATA_id"] = $recent["id"];
$_SESSION["SONG_DATA_annotation"] = $recent["annotation"];
$_SESSION["song_1"]=$recent["song_1"];
$_SESSION["song_2"]=$recent["song_2"];
$conn->close();
?>

<!-- Introduction Part -->
<h1> Introduction </h1>
<form>
<table style = "width: 60%">
<tr>
<td>
<p>Thank you for participating! You will rank arousal and valence of two songs.</p>

<p>Arousal is about energy and tension of a song. High arousal indicates that the song is energetic and exiciting.
Low arousal indicates that the song is boring and sleepy.
</p>

<p>Valence is about positive and negative affective states of a song. 
For example, happy or pleasing song is considered as high valence and depressing or sad song is considered as low valence.
</p>

Following figure is a Thayer's arousal-valence plane. We adopted this plane to represent emotion of music. It uses arousal and valence
value to determine emotion. Some emotions can be expressed as a combination of arousal and valence value.<br>

<ul style="list-style-type:disc">
  <li>Joyful = high arousal + high valence </li>
  <li>Angry = high arousal + low valence </li>
</ul>  

At the first measurement page, you only have to pick the song has high arousal. And at the second measurement page,
you will select the song has high valence. (5-seconds per each song)

<!-- Instruction Part -->
<h1> Instructions</h1>
<ul style="list-style-type:square">
  <li> Move your cursor to audio player below to play a song. </li>
  <li> If mouse leaves the audio player, music stops. </li>
  <li> Listen example songs to get the picture of arousal and valence </li>
  <li> Click start button to rank songs! </li>
</ul>  

<h2>Arousal - Valence Emotion Plane</h2>
<img alt="Emotion Plane" src="Emotion_Plane.png">
</td>
</tr>
</table>
</form>

<br>

<!-- 
		A Table for media player.
		High Arousal | Low Arousal
		High Valence | Low Valence
-->
<table style = "width: 60%">
<tr>
<td> <input type="button" value="Start" style="float: right; width: 200px" onclick="location.href='Arousal.php'"> </td>
</tr>
</table>
<h1>Arousal</h1>
<h3> Examples </h3>
<table style = "width: 60%">
	<tr>
		<td width = "30%"> High Arousal: </td>
		<td width = "30%"> Low Arousal: </td>
	</tr>
	<tr>
	<td>
	<div onmouseover="PlaySound('High_Arousal')"
     onmouseout="PauseSound('High_Arousal')"
     style="width: 532px;">
    <audio id='High_Arousal' controls> 
		<source src="HA_Example.mp3">
	</audio></div> </td>
	<td>
	<div onmouseover="PlaySound('Low_Arousal')"
     onmouseout="PauseSound('Low_Arousal')"
     style="width: 532px;">
    <audio id='Low_Arousal' controls> 
		<source src="LA_Example.mp3">
	</audio> </div> </td>
	</tr>
</table>

<h1>Valence</h1>
<h3> Examples</h3>
<table style = "width: 60%">
	<tr>
		<td width = "30%"> High Valence: </td>
		<td width = "30%"> Low Valence: </td>
	</tr>
	<tr>
	<td>
	<div onmouseover="PlaySound('Positive Valence')"
     onmouseout="PauseSound('Positive Valence')"
     style="width: 532px;">
    <audio id='Positive Valence' controls> 
		<source src="HV_Example.mp3">
	</audio></div> </td>
	<td>
	<div onmouseover="PlaySound('Negative Valence')"
     onmouseout="PauseSound('Negative Valence')"
     style="width: 532px;">
    <audio id='Negative Valence' controls> 
		<source src="LV_Example.mp3">
	</audio> </div> </td>
	</tr>
</table>


<script>
function PlaySound(soundobj) {
    var thissound=document.getElementById(soundobj);
    thissound.play();
}

function PauseSound(soundobj) {
    var thissound=document.getElementById(soundobj);
    thissound.pause();
}
</script>
</body>
</html>