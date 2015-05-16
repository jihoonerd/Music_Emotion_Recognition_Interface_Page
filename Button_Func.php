<?php
	session_start();
	
	// Function for Arousal Page - Select A button
	if(isset($_POST['choice_Arousal']) && $_POST['choice_Arousal'] == "ButtonA_Arousal"){
		$_SESSION["Selected_Arousal"] = $_SESSION["song_1"];
		echo "A is selected.";
	}
	
	// Function for Arousal Page - Select B button
	else if(isset($_POST['choice_Arousal']) && $_POST['choice_Arousal'] == "ButtonB_Arousal"){
		$_SESSION["Selected_Arousal"] = $_SESSION["song_2"];
		echo "B is selected.";
	}
	
	// Function for Valence Page - Select A button
	if(isset($_POST['choice_Valence']) && $_POST['choice_Valence'] == "ButtonA_Valence"){
		$_SESSION["Selected_Valence"] = $_SESSION["song_1"];
		echo "A is selected.";
	}
	
	// Function for Valence Page - Select B button
	else if(isset($_POST['choice_Valence']) && $_POST['choice_Valence'] == "ButtonB_Valence"){
		$_SESSION["Selected_Valence"] = $_SESSION["song_2"];
		echo "B is selected.";
	}
?>