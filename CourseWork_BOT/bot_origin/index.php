<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
<?php 
		include('BotAPI.php');
		$object = new WebBot_API;
		$object->BotCssHTML();
?>
		
	</style>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	



	
<?php 	$object->BotPanelHTML();	?>

<?php 	$object->BotEngine();	?>

</body>
</html>