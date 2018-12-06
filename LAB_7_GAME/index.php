<html>
<head>
	<meta charset="UTF-8">
	<title>GAME BY ISMOILOV</title>
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<style>
		body, div, p
		{
			margin: 0;
			padding: 0;
		}
		body{background-image: url('card_bg.jpg'); background-size: cover;}
		.container_prel
		{
			width: 34%;
			margin: 0 auto;
			padding-top: 180px;
			padding-left: 15%;
		}
		.game_zone
		{
			background-color: rgba(0,0,0,0.5);
			height: 545px;
			width: 90%;
			margin: 0 auto;
			padding: 15px;
			text-align: center;
		}
		.game_zone input:hover
		{
			transition: .2s ease-in-out;
			box-shadow: 1px 1px 20px rgba(200,150,0,1);
		}
		.btn1_newgame
		{
			transition: .2s;
			background-color: #00cc00;
		}
		.btn1_newplayer
		{
			transition: .2s;
			background-color: #bb0000;
		}

	</style>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	
	<div id="preloader_game" style="width: 100%; background-color: #077; height: 2000px;" class="preloader">
		<div class="container_prel">
			<svg width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-pacman" style="background: none;"><g ng-attr-style="display:{{config.showBean}}" style="display:block"><circle cx="37.6571" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ed5e16"><animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.7" begin="-0.469s" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.7" begin="-0.469s" repeatCount="indefinite"></animate></circle><circle cx="58.0571" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ed5e16"><animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.7" begin="-0.23099999999999998s" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.7" begin="-0.23099999999999998s" repeatCount="indefinite"></animate></circle><circle cx="77.8571" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ed5e16"><animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="0.7" begin="0s" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="0.7" begin="0s" repeatCount="indefinite"></animate></circle></g><g ng-attr-transform="translate({{config.showBeanOffset}} 0)" transform="translate(-15 0)"><path d="M50 50L20 50A30 30 0 0 0 80 50Z" ng-attr-fill="{{config.c1}}" fill="#fcf609" transform="rotate(25.7143 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.7s" begin="0s" repeatCount="indefinite"></animateTransform></path><path d="M50 50L20 50A30 30 0 0 1 80 50Z" ng-attr-fill="{{config.c1}}" fill="#fcf609" transform="rotate(-25.7143 50 50)"><animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.7s" begin="0s" repeatCount="indefinite"></animateTransform></path></g></svg>
		</div>	
	</div>
	

	<h1 style="text-align: center; color: #fff; padding-top: 15px; font-family: 'Lobster', cursive; font-weight: normal; ">Добро пожаловать в карточную игру "ЯБЛОН"!</h1>
	
	


	<div class="game_zone">
		<div id="gamer_data">
			<h2 style="color: #fff;">Введите ваше имя:</h2>
			<input id="gamer_name_data" type="text" style="background-color: #eee;" class="btn1_newgame">
			<br><br>
			<input id="save_gamer_data" class="btn1_newgame" style="color: #000; border: none; padding: 15px; width: 200px; background-color: #cc0; " type="button" value="Сохранить">
		</div>
	<br>

		<div id="begin_game">
			<div style="width: 340px; height: 280px; -webkit-background-size: cover; background-size: cover; background: url('img/splash_img.jpg'); margin: 0 auto;">
			</div>
			<br>
			<input id="start_new_game" class="btn1_newgame" style="color: #fff; border: none; padding: 15px; width: 200px; " type="button" value="Начать игру">
			<br>
			<br>
			<input id="add_game_player" class="btn1_newplayer" style="color: #fff; border: none; padding: 15px; width: 200px; " type="button" value="Добавить игрока">
		</div>
		<div style="height: 100px; padding: 15px;" id="gamers"></div>
		
		
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<div id="bankomet">
			<h2 style="color: #fff;">Банкомет >> <input id="share_cards" class="btn1_newgame" style="color: #fff; border: none; padding: 15px; width: 200px; background-color: #ac00ac;" type="button" value="Раздать карты"></h2>
		</div>

	</div>


	<?php 

		include('script.php');

		echo start_interface();
		echo Save_gamer_data();
		echo Add_players();
		echo New_Game();
		echo Share_Cards();

	 ?>

</body>
</html>