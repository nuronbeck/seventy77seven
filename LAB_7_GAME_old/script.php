<?php 
	function script_head()
	{
		echo "<script>";
	}
	function start_interface()
	{
	?>
		<script>
		$(document).ready(function()
		{
			var preloader = $('#preloader_game');
			setTimeout(function(){
				preloader.css('display', 'none');
			}, 400);

		});

		$(window).on('load', function ()
		{	
			$('#begin_game').hide();
			$('#bankomet').hide();
			$('body').css('overflow-y', 'hidden');
			var preloader = $('#preloader_game');
			preloader.delay(500).fadeOut('slow');
			setTimeout(function()
				{
					$('body').css('overflow-y', 'auto');
				}, 	500);			
		});
		</script>
	<?php
	}

	function Save_gamer_data()
	{
	?>

		<script>
		$('#save_gamer_data').bind("click", function()
		{
			var gamer_name = $('#gamer_name_data').val();
			if (gamer_name != "" && gamer_name != null)
			{
				$('#gamers').append("<span style=\"color: #ff0;\">GAMER STATUS</span><div class=\"gmr\" id=\"gamer1\" style=\"margin: 5px; display: inline-block; width: 100px; background-color: #ee2020; padding: 10px; font-weight: bold; border-radius: 3px;\">"+gamer_name+"<br>Баланс: <span>800</span></div><br><br><hr style=\"border: 1px solid #fff;\">");
				$('#gamer_data').hide();
				$('#begin_game').show();
			}
			else
			{
				alert("ВВЕДИТЕ ВАШЕ ИМЯ!");
			}
		});
		</script>

	<?php 		
	}


	function Add_players()
	{
	?>

		<script>
			$('#add_game_player').bind("click", function()
		{
			if ($('#gamers').children('div').length  == 4)
			{
				alert("Слишком много игроков!");
			}
			else
			{
				if ($('#gamers').children('div').length == 0)
				{
					var random_balance = Math.floor(Math.random()*1000);
					$('#gamers').append("<span style=\"color: #ff0;\"></span><div class=\"gmr\" id=\"gamer1\" style=\"margin: 5px; display: inline-block; width: 100px; background-color: #8888ff; padding: 10px; font-weight: bold; border-radius: 3px;\">Игрок 1<br>Баланс: <span>"+random_balance+"</span><br></div><hr style=\"border: 1px solid #fff;\">");
				}
				else
				{
					var random_balance = Math.floor(Math.random()*1000);
					var newgamer = $('#gamers').children('div').last().attr('id');
					var id_split = newgamer.split("gamer");
					var new_id = parseInt(id_split[1])+1;
					$('#gamers').append("<span style=\"color: #ff0;\">GAMER STATUS</span><div class=\"gmr\" id=\"gamer"+new_id+"\" style=\"margin: 5px; display: inline-block; width: 100px; background-color: #8888ff; padding: 10px; font-weight: bold; border-radius: 3px;\">Игрок "+new_id+"<br>Баланс: <span>"+random_balance+"</span><br></div><br><br><hr style=\"border: 1px solid #fff;\">");
				}
			}
		});
		</script>

	<?php
	}


	function New_Game()
	{
	?>
		
		<script>
		$('#start_new_game').bind("click", function()
		{
			$('#begin_game').hide();
			$('#bankomet').show();
		});

		var only_first_deal = 0;
		var suits = ['Черв', 'Пик', 'Крест', 'Буб'];
		var cards = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'Валет', 'Дама', 'Король', 'Туз'];
		var dealed_cards = [];

		</script>

	<?php
	}

	function Share_Cards()
	{
	?>

		<script>
			$('#share_cards').bind('click', function()
		{
			if ($('#share_cards').val() == "Новая игра")
			{
				location.reload();
			}
			if ($('#share_cards').val() == "Вывести результат")
			{
				$('.gmr').each(function()
				{
					var card1 = $(this).nextAll('.cards_block').slice(0, 1).html();
					var card2 = $(this).nextAll('.cards_block').slice(1, 2).html();
					var card3 = $(this).nextAll('.cards_block').slice(2, 3).html();

					var brExp = /<br\s*\/?>/i;
    				var card1_lines = card1.split(brExp);
    				var card2_lines = card2.split(brExp);
    				var card3_lines = card3.split(brExp);
    				//alert(card1_lines[0]);

    				if (card1_lines[0] == 'Валет'){card1_lines[0] = 11;}
    				if (card1_lines[0] == 'Дама'){card1_lines[0] = 12;}
    				if (card1_lines[0] == 'Король'){card1_lines[0] = 13;}
    				if (card1_lines[0] == 'Туз'){card1_lines[0] = 14;}

    				if (card2_lines[0] == 'Валет'){card2_lines[0] = 11;}
    				if (card2_lines[0] == 'Дама'){card2_lines[0] = 12;}
    				if (card2_lines[0] == 'Король'){card2_lines[0] = 13;}
    				if (card2_lines[0] == 'Туз'){card2_lines[0] = 14;}

    				if (card3_lines[0] == 'Валет'){card3_lines[0] = 11;}
    				if (card3_lines[0] == 'Дама'){card3_lines[0] = 12;}
    				if (card3_lines[0] == 'Король'){card3_lines[0] = 13;}
    				if (card3_lines[0] == 'Туз'){card3_lines[0] = 14;}

    				//Result
    				
    				if (card1_lines[0] < card2_lines[0] && card2_lines[0] < card3_lines[0])
    				{
    					
    					var str = $(this).prev('span').text();
    					var win_summ = str.split(':');
    					var balance = $(this).children('span').text();
    					$(this).children('span').text(parseInt(balance)+(2*parseInt(win_summ[1])));

    					$(this).prev('span').text('Выиграна');
    					$(this).prev('span').css('color', '#10ff00');

    				}
    				else
    				{
    					$(this).prev('span').text('Проиграна');
    					$(this).prev('span').css('color', '#f2101f');
    				}

    			
				});

				setTimeout(function()
				{
					$('#share_cards').css('background-color', '#000');
					$('#share_cards').css('color', '#0f0');
					$('#share_cards').val("Новая игра");
				}, 1000);
			}
			else
			{

			if (only_first_deal == 0)
			{
				for (var i = 1; i <= $('#gamers div').length; i++)
				{
					for (var j = 0; j < 2; j++)
					{
						var random_suit = suits[Math.floor(Math.random()*suits.length)];
						var random_card = cards[Math.floor(Math.random()*cards.length)];

						var check_card = random_card+random_suit+"";

						if ($.inArray(check_card, dealed_cards) == -1)
						{
							$('#gamer'+i).after("<div class=\"cards_block\" style=\"margin: 5px; display: none; width: 70px; height: 80px;background-color: #fff; padding: 10px 2px; font-weight: bold; border-radius: 3px; color: black; box-sizing: border-box;\">"+random_card+"<br>"+random_suit+"</div>");	

							$('.cards_block').slideDown(function()
							{
								$('.cards_block').css('display', 'inline-block');
							});

							dealed_cards.push(random_card+random_suit);
							
						}
						else
						{
							var random_suit = suits[Math.floor(Math.random()*suits.length)];
							var random_card = cards[Math.floor(Math.random()*cards.length)];
							var check_card = random_card+random_suit+"";

							if ($.inArray(check_card, dealed_cards) == -1)
							{
								$('#gamer'+i).after("<div class=\"cards_block\" style=\"margin: 5px; display: none; width: 70px; height: 80px;background-color: #fff; padding: 10px 2px; font-weight: bold; border-radius: 3px; color: black; box-sizing: border-box;\">"+random_card+"<br>"+random_suit+"</div>");	

								$('.cards_block').slideDown(function()
								{
									$('.cards_block').css('display', 'inline-block');
								});

								dealed_cards.push(random_card+random_suit);
								
							}
						}

					}

				}

				setTimeout(function()
				{
					$('#share_cards').css('background-color', '#0f0');
					$('#share_cards').val("Решить ставку");
				}, 1000);
				only_first_deal = only_first_deal+1;
			}
			else
			{
				if ($('#share_cards').val() == "Решить ставку") 
				{
					var result = window.confirm('Будете делать ставку ?');
				}
				
				if (result == true)
				{
					var summ_stavka = prompt('Введите сумму ставки?', "");
					if (summ_stavka < $('#gamer1 span').text())
					{
						var gamer1_cash = $('#gamer1 span').text();
						$('#gamer1 span').text(gamer1_cash-summ_stavka);
						$('#gamer1').prev('span').text("СТАВКА:"+summ_stavka);


							$('.gmr').each(function()
							{
								if ($(this).prev('span').text() == "GAMER STATUS")
								{
									var bet_rnd = Boolean(Math.floor(Math.random() * 2));
									//alert(bet_rnd);

									if (bet_rnd == true)
									{
										var gamer_bet_summ = $(this).children('span').text();
										//alert(gamer_bet_summ);
										var rnd = Math.floor(Math.random()*gamer_bet_summ);
										$(this).children('span').text(gamer_bet_summ-rnd);
										$(this).prev('span').text("СТАВКА:"+rnd);
									}
									else
									{
										$(this).prev('span').text("ПАСС!");
										$(this).prev('span').css('color', '#ff0000');
									}
									
								}

							});
						
					}
					alert("Сейчас всем игрокам будет раздана третья карта (Промежуточная карта)!");
					setTimeout(function()
					{
						setTimeout(function()
						{
							$('.gmr').each(function()
							{
								if ($(this).prev('span').text().indexOf('ПАСС!') > -1 && $(this).prev('span').text().indexOf('СТАВКА') == -1)
								{
										$(this).prev('span').remove();
										$(this).nextUntil('hr').remove();
										$(this).next('hr').remove();
										$(this).remove();

										for (var i = 1; i <= $('#gamers div').length; i++)
										{
											for (var j = 0; j < 1; j++)
											{
												var random_suit = suits[Math.floor(Math.random()*suits.length)];
												var random_card = cards[Math.floor(Math.random()*cards.length)];

												var check_card = random_card+random_suit+"";

												if ($.inArray(check_card, dealed_cards) == -1)
												{
													$('#gamer'+i).next().after("<div class=\"cards_block\" style=\"margin: 5px; display: none; width: 70px; height: 80px;background-color: #0ff; padding: 10px 2px; font-weight: bold; border-radius: 3px; color: black; box-sizing: border-box;\">"+random_card+"<br>"+random_suit+"</div>");	

													$('.cards_block').slideDown(function()
													{
														$('.cards_block').css('display', 'inline-block');
													});

													dealed_cards.push(random_card+random_suit);
													
												}
												else
												{
													var random_suit = suits[Math.floor(Math.random()*suits.length)];
													var random_card = cards[Math.floor(Math.random()*cards.length)];

													var check_card = random_card+random_suit+"";
													if ($.inArray(check_card, dealed_cards) == -1)
													{
														$('#gamer'+i).next().after("<div class=\"cards_block\" style=\"margin: 5px; display: none; width: 70px; height: 80px;background-color: #0ff; padding: 10px 2px; font-weight: bold; border-radius: 3px; color: black; box-sizing: border-box;\">"+random_card+"<br>"+random_suit+"</div>");	

														$('.cards_block').slideDown(function()
														{
															$('.cards_block').css('display', 'inline-block');
														});

														dealed_cards.push(random_card+random_suit);
														
													}
												}

											}

										}
								}
								else
								{}
							
							setTimeout(function()
							{
								$('#share_cards').val("Вывести результат");
								$('#share_cards').css('background-color', '#ee0000');
							}, 1000);

							});
						}, 2000);
						
					}, 1200);
				}
			}
			}

			
		});
		</script>

	<?php
	}

	function script_footer()
	{
		echo "</script>";
	}

 ?>