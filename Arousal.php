<!DOCTYPE php>
<html lang="en-US">
<head>
<title>Arousal</title>
<meta charset="UTF-8">
<!-- AJAX for submitting the information of selected button -->
<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('input[type="submit"]').click(function(){
	     $('#choice_Arousal').val(this.name)
		    $.ajax({  
		      type: "POST",
		      url: "Button_Func.php",  
		      data: $("#choice_Arousal").serialize(), 
		      success: function(data) {
		    	  $('#result_Arousal').html(data);
		      }
	   		});  
    return false;       
  });
});
</script>
</head>

<form>
<h1>Measurement of Arousal</h1>
<h2> Instructions</h2>
<table style = "width: 70%">
<tr>
<td>
<ul style="list-style-type:square">
  <li> Move your cursor to media player to play a song. </li>
  <li> Each song is 5 second. </li>
  <li> If mouse leaves the audio player, music stops. </li>
  <li> Listen both songs.</li>
  <li> Click A or B button to select a song which is more exciting and energetic. </li>
  <li> You can change your decision before clicking next button. </li>
  <li> <font color="red">Next button will be enabled after both songs end. </font> </li>
</ul>  
</td>
</tr>
</table>
</form>

<?php 
session_start();
?>

<h3> Evaluation </h3>
<form action="" method="post" id="input">
<input type="hidden" name="choice_Arousal" id="choice_Arousal" value="update">
<table style = "width: 50%">
	<tr>
		<td> Audio A: </td>
		<td> Audio B: </td>
	</tr>
	<tr>
	<td>
	<div onmouseover="PlaySound('Audio_A_Arousal')"
     onmouseout="PauseSound('Audio_A_Arousal')">
    <audio onended="endA()" id='Audio_A_Arousal' controls> 
		<source src="<?php echo $_SESSION["song_1"]?>">
	</audio> </div> </td>
	<td>
	<div onmouseover="PlaySound('Audio_B_Arousal')"
     onmouseout="PauseSound('Audio_B_Arousal')">
    <audio onended="endB()" id='Audio_B_Arousal' controls> 
		<source src="<?php echo $_SESSION["song_2"]?>">
	</audio> </div> </td>
	</tr>
	<tr>
	<td> 
	<input type="submit" name="ButtonA_Arousal" style="float:right; width: 200px" value="A"	>
	</td>
	<td> 
	<input type="submit" name="ButtonB_Arousal" style="float:right; width: 200px" value="B" >
	</td>
	</tr>
	<tr>
	<td> </td>
	<td> <textarea  id="result_Arousal" style="font-size: 20pt; overflow:hidden; float:right; height: 60px; width:300px"></textarea> <br><br><br><br> 
	<input type="button" id = 'toValence' value="Next" style="float: right; width: 200px" onclick="location.href='Valence.php'" disabled="disabled"></td>
	</tr>
</table>
</form>
<br>

<!-- 
	endA() and endB(): function check whether the both songs end or not.
	endableButton(): It enables a 'Next' Button.
	PlaySound(): Function for playing examples.
	PauseSound(): Functino for pausing examples.

-->
<script type="text/javascript">
var A = false;
var B = false;
function endA()
{
	A = true;
	if (B == true)
	{
		enableButton();
	}
}

function endB()
{
	B = true;
	if (A == true)
	{
		enableButton();
	}
}

function enableButton() {
	document.getElementById('toValence').disabled = null;
}
	

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