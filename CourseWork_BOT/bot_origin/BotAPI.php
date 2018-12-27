<?php 
	class WebBot_API
	{
		function BotPanelHTML()
		{
			echo 
			"<div class=\"bot_container\">
				<div class=\"bot_block\">
					<div class=\"bot_block_header\"><label>Запись на прием</label><label class=\"bot_block_close\">X</label></div>
					<div class=\"bot_block_textarea\">
						<form id=\"bot_result_reply\">
							Хотите записаться на прием? <br>
						<label>Введите номер телефона: <input type=\"tel\" name=\"phone\"></label>
						<input type=\"hidden\" name=\"stage\" value=\"start\">
					</form>
					<button class=\"bot_block_button\" onclick=\"Send();\">Далее</button>
					<button class=\"bot_block_button\" id=\"back_button\" onclick=\"Back();\">Назад</button>

					</div>
				</div>

				<div class=\"bot_logo\"><img src=\"bot_logo3.png\" alt=\"\"></div>
			</div>";
		}

		function BotCssHTML()
		{
			echo
			"@import url('https://fonts.googleapis.com/css?family=Roboto');
			.bot_container
			{
				width: 340px;
				box-sizing: border-box;
				position: absolute;
				top: 0;
				left: 0;
			}
			.bot_container .bot_logo img
			{
				width: 70px;
				border-radius: 50%;
				box-shadow: 1px 1px 5px #000;
				transition: 0.3s;
			}
			.bot_container .bot_logo img:hover
			{
				border-radius: 30%;
				box-shadow: 1px 1px 25px #0000ff;
				transition: 0.3s ease-in-out;
			}
			.bot_container .bot_logo
			{
				text-align: center;
				padding-left: 180px;
				display: none;
			}
			.bot_block
			{
				height: 450px;
				width: 340px;
				background-color: #F5F5F6;
				box-sizing: border-box;
				border-radius: 3px;
			}
			.bot_block_header
			{
				background-color: #2196f3;
				color: #fff;
				font-family: Roboto,serif;
				padding-top: 20px;
				padding-left: 20px;
				padding-right: 20px;
				height: 40px;
			}
			.bot_block_header label
			{
				padding: 10px;
				background-color: #64b5f6;
				border-radius: 3px;
			}
			.bot_block_header .bot_block_close
			{
				background-color: #d50000;
				text-align: right;
				cursor: pointer;
				margin-left: 42%;
				padding: 10px 13px;
			}
			.bot_block_textarea
			{
				height: 300px;
				padding: 30px;
				overflow: auto;
				box-sizing: border-box;
			}
			#back_button
			{
				display: none;
			}
			"
			;
		}
		function BotEngine()
		{
			echo 
			"<script>

				var screen_height = $(window).height();
				var screen_width = $(window).width();

				$( \".bot_container\" ).css( \"margin-left\", \"\"+(screen_width-346)+\"\");
				$( \".bot_container\" ).css( \"margin-top\", \"\"+(screen_height-456)+\"\");

				$(document).ready(function()
					{
						var screen_height = $(window).height();
						var screen_width = $(window).width();

						$( \".bot_container\" ).css( \"margin-left\", \"\"+(screen_width-346)+\"\");
						$( \".bot_container\" ).css( \"margin-top\", \"\"+(screen_height-456)+\"\");


						$('.bot_block').slideUp(\"fast\");
						$('.bot_logo').toggle(\"slow\", function()
									{
										//$('.bot_container').animate({margin-top:\" \"+(screen_height-80)+\"\"}, 500);
										$('.bot_container').animate({
									    marginTop: (screen_height-80)
									  }, 500 );
									});

						

						$('.bot_block_close').bind(\"click\", function()
							{
								$('.bot_block').slideUp(\"slow\");
								$('.bot_logo').toggle(\"slow\", function()
									{
										//$('.bot_container').animate({margin-top:\" \"+(screen_height-80)+\"\"}, 500);
										$('.bot_container').animate({
									    marginTop: (screen_height-80)
									  }, 500 );
									});
								
								//.bot_container .bot_logo
						});

						$('.bot_logo img').bind(\"click\", function()
							{
								$('.bot_container').animate({
									    marginTop: (screen_height-450)
									  }, 500 );
								$('.bot_block').slideDown(\"slow\");
								$('.bot_logo').toggle(\"slow\");
								$('.bot_logo').css(\"margin-top\", \"\"+(screen_height-80)+\"\");
								//.bot_container .bot_logo
							});
					});

				function Send()
				{
		            var data = $(\"#bot_result_reply\").serialize();
		            $.ajax
		            ({
		                type: 'POST',
		                data: data,
		                url: 'script.php',
		                success: function(data)
		                {
		                	$('#bot_result_reply').slideUp(\"fast\", function()
		                	{
		                		$('#bot_result_reply').html(data);
		                		$('#bot_result_reply').slideDown();
		                	});
		                    
		                }
		            });
		        }

		        function Back()
				{
		            var data = $(\"form\").serialize();
		            data += '&back=true';
		            $.ajax
		            ({
		                type: 'POST',
		                data: data,
		                url: 'script.php',
		                success: function(data)
		                {
		                    $('#bot_result_reply').html(data);
		                    $('#bot_result_reply').slideDown();
		                }
		            });
		        }

			</script>"
			;
		}
	}
 ?>