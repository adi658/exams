<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if((isset($_SESSION["userlogin"])) && $_SESSION["userlogin"]!="")
	{
		include_once("config.php");
	}
	else
	{
		?>
			<script>
				window.location.href = "login.php";
			</script>
		<?php
		exit;
	}
?>
<div class = "headerDiv">
	<h1><a href = "index.php">IGNOU - On Demand Exam</a></h1>
	<div class = "menu">
		<div style = "width:70%;float:center;" >
			<a href = "addSubject.php">Add Subject</a> |
			<a href = "addSubTopic.php">Add SubTopic</a> |
			<a href = "addQuestion.php">Add Question</a> |
			<a href = "addTemplate.php">Add Template</a> |
			<a href = "buildTemplate.php">Build Template </a> | 
			<a href = "generatePaper.php">Generate Paper </a>
		</div>
		<div style = "width:20%;float:right;margin-right:30px;margin-top:-15px;" align = "right">
			Welcome <?php echo(strtoupper($_SESSION["userlogin"]));?>, (<a href = "logout.php">Logout</a>)
		</div>
	</div>
</div>

<?php
	if((isset($_SESSION["Msg"])) && $_SESSION["Msg"]!="")
	{
		echo "<center>".$_SESSION["Msg"]."</center>";
	}
	$_SESSION["Msg"]= "";
?>