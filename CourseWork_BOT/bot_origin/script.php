<?php

	function GetWeekdayName($n)
	{
		$name;
	    switch ($n)
	    {
	    	case '0': $name = 'ПН'; break;
	    	case '1': $name = 'ВТ'; break;
	    	case '2': $name = 'СР'; break;
	    	case '3': $name = 'ЧТ'; break;
	    	case '4': $name = 'ПТ'; break;
	    	case '5': $name = 'СБ'; break;
	    	case '6': $name = 'ВС'; break;
	    	default: $name = null; break;
	    }
	    return $name;
	}

	$stage = $_POST['stage'];

	if (isset($_POST['back']))
	{
		switch ($stage)
		{
			case 'doc':
				$stage = 'start';
				break;

			case 'date':
				$stage = 'branch';
				break;

			case 'time':
				$stage = 'doc';
				break;
			
			case 'acceptation':
				$stage = 'date';
				break;

			case 'end':
				$stage = 'date';
				break;

			default: break;
		}
	}

	$form;

	$db = @mysqli_connect('localhost', 'id2287230_noreck77', 'dataproger123', 'id2287230_noreck');
	switch ($stage)
	{
		case 'before_start':
			$form = 'Хотите записаться на прием? <br><br>
				<label>Заполните номер телефона <input type="tel" name="phone" placeholder="8xxxxxxxxxx"></label>
				<input type="hidden" name="stage" value="start">';
			break;
		//________________________________________________________________________________START
		case 'start':
			$phone = $_POST['phone'];

			$query = "SELECT id, name FROM users WHERE phone = $phone;";
			$user = @mysqli_fetch_all(mysqli_query($db, $query), 1);

			if ($user)
			{
				$form = 'Здравствуйте, ' . $user[0]['name'];

				$form .= '<input type="hidden" name="stage" value="branch">
				<input type="hidden" name="user" value="' .  $user[0]['id'] . '">';
			}
			else
			{
				$form = 'Заполните анкету: <br>
				<input type="text" name="name" placeholder="Имя*"><br>
				<input type="text" name="surname" placeholder="Фамилия"><br>
				<input type="text" name="patronymic" placeholder="Отчество"><br>';

				$form .= '<input type="hidden" name="stage" value="reg">' . 
				'<input type="hidden" name="phone" value="' . $phone . '">';
			}

			$form .= '<script>document.getElementById("back_button").style.display = "none";</script>';
			break;



		//________________________________________________________________________________REG
		case 'reg':
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$patronymic = $_POST['patronymic'];
			$phone = $_POST['phone'];

			$query = "INSERT INTO users (name, surname, patronymic, phone) VALUES ('$name','$surname','$patronymic','$phone')";
			@mysqli_query($db, $query);

			$query = "SELECT id FROM users WHERE phone = $phone;";
			$user = @mysqli_fetch_all(mysqli_query($db, $query), 1);

			$form = "Регистрация прошла успешно";			
			$form .= '<input type="hidden" name="stage" value="branch">
			<input type="hidden" name="user" value="' .  $user[0]['id'] . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "none";</script>';

			break;



		//________________________________________________________________________________BRANCH
		case 'branch':
			$user_id = $_POST['user'];

			$query = "SELECT id, branch FROM branches;";
			$branches = @mysqli_fetch_all(mysqli_query($db, $query), 1);

			$form = "Выберите филиал: <br>";
			foreach ($branches as $b)
			{
				$form .= "<label><input type='radio' name='branch' value='" . $b['id'] . "'>" . 
				$b['branch'] . " " . 
				"</label><br>";
			}
			$form .= '<input type="hidden" name="stage" value="doc">' . 
			'<input type="hidden" name="user" value="' .  $user_id . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "none";</script>';
			break;



		//________________________________________________________________________________CD
		case 'doc':
			$user_id = $_POST['user'];
			$branch_id = $_POST['branch'];

			$query = "SELECT DISTINCT visits.doctor, doctors.name, doctors.surname, specialties.specialty FROM visits INNER JOIN doctors ON visits.doctor = doctors.id INNER JOIN specialties ON doctors.specialty = specialties.id WHERE visits.branch = '$branch_id' AND visits.user IS NULL;";
			$doctors = @mysqli_fetch_all(mysqli_query($db, $query), 1);

			$query = "SELECT branch FROM branches WHERE id = '$branch_id';";
			$bc = "> " . @mysqli_fetch_all(mysqli_query($db, $query), 1)[0]['branch'] . "<br>";


			$form = $bc . "<br>Выберите врача: <br>";
			foreach ($doctors as $doc)
			{
				$form .= "<label><input type='radio' name='doc' value='" . $doc['doctor'] . "'>" . 
				$doc['specialty'] . " - " .
				$doc['surname'] . " " . 
				$doc['name']  . 
				"</label><br>";
			}

			$form .= '<input type="hidden" name="stage" value="date">' . 
			'<input type="hidden" name="user" value="' .  $user_id . '">' .
			'<input type="hidden" name="branch" value="' .  $branch_id . '">' . 
			'<input type="hidden" name="bc" value="' .  $bc . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "block";</script>';
			break;



		//________________________________________________________________________________DATE
		case 'date':
			$user_id = $_POST['user'];
			$branch_id = $_POST['branch'];
			$doc_id = $_POST['doc'];
			$bc = $_POST['bc'];

			$query = "SELECT DISTINCT weekday FROM visits WHERE branch = '$branch_id' AND doctor = '$doc_id';";
			$t_wd = @mysqli_fetch_all(mysqli_query($db, $query), 1);
			$a_wd = array();
			foreach ($t_wd as $w)
			{
				$a_wd[] = $w['weekday'];
			}

			$query = "SELECT doctors.surname, doctors.name, specialties.specialty FROM doctors INNER JOIN specialties ON doctors.specialty = specialties.id WHERE doctors.id = '$doc_id';";
			$doc = @mysqli_fetch_all(mysqli_query($db, $query), 1)[0];
			$doc = $doc['surname'] . " " . $doc['name'] . " - " . $doc['specialty'];
			if (isset($_POST['back']))
			{
				$s = explode(">", $bc);
				$bc = ">" . $s[1] . "> ";
			}
			$bc .= "> " . $doc . "<br>";


			$d = date('d') + 1;
			$m = date('m');
			$y = date('y');

			$form = $bc . "<br>Выберите дату: <br>";
			for ($i = 0; $i < 7; $i++)
			{
				$date = mktime(0, 0, 0, $m, $d + $i, $y);
				$weekday = (date('N', $date) - 1);

				if (in_array($weekday, $a_wd))
				{
					$d_date = date('d.m', $date);

					$form .= "<label><input type='radio' name='date' value='" . $weekday . "_" . $d_date ."'>" .  
					GetWeekdayName($weekday) . " - " . $d_date .
					"</label><br>";
				}
			}
			
			$form .= '<input type="hidden" name="stage" value="time">' . 
			'<input type="hidden" name="user" value="' .  $user_id . '">' . 
			'<input type="hidden" name="branch" value="' .  $branch_id . '">' . 
			'<input type="hidden" name="doc" value="' .  $doc_id . '">' .
			'<input type="hidden" name="bc" value="' .  $bc . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "block";</script>';
			break;



		//________________________________________________________________________________TIME
		case 'time':
			$user_id = $_POST['user'];
			$doc_id = $_POST['doc'];
			$branch_id = $_POST['branch'];
			$weekday = explode('_', $_POST['date'])[0];
			$date = explode('_', $_POST['date'])[1];
			$bc = $_POST['bc'];

			$query = "SELECT id, time FROM visits WHERE doctor = '$doc_id' AND weekday = '$weekday' AND user IS NULL;";
			$free_visits = @mysqli_fetch_all(mysqli_query($db, $query), 1);
			$bc .= "> " . GetWeekdayName($weekday) . " - " . $date . "<br>";

			$form = $bc . "<br>Выберите время: <br>";
			foreach ($free_visits as $visit)
			{
				$form .= "<label><input type='radio' name='visit' value='" . $visit['id'] . "'>" . 
				$visit['time'] . " " .
				"</label><br>";
			}

			$form .= '<input type="hidden" name="stage" value="acceptation">' . 
			'<input type="hidden" name="user" value="' .  $user_id . '">' . 
			'<input type="hidden" name="branch" value="' .  $branch_id . '">' . 
			'<input type="hidden" name="doc" value="' .  $doc_id . '">' .
			'<input type="hidden" name="bc" value="' .  $bc . '">' . 
			'<input type="hidden" name="date" value="' .  $date . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "block";</script>';
			break;




		//________________________________________________________________________________ACC
		case 'acceptation':
			$user_id = $_POST['user'];
			$doc_id = $_POST['doc'];
			$branch_id = $_POST['branch'];
			$visit = $_POST['visit'];
			$date = $_POST['date'];
			$bc = $_POST['bc'];

			$query = "SELECT doctors.name, doctors.surname, specialties.specialty, visits.weekday, visits.time, branches.branch FROM visits 
			INNER JOIN branches ON visits.branch = branches.id
			INNER JOIN doctors ON visits.doctor = doctors.id 
			INNER JOIN specialties ON doctors.specialty = specialties.id 
			WHERE visits.id = '$visit';";
			$result = @mysqli_fetch_all(mysqli_query($db, $query), 1)[0];

			$form = "<b>Филиал:</b> " . $result['branch'] . "<br>" . 
			"<b>Доктор:</b> " . $result['name'] . " " . $result['surname'] . " - " . $result['specialty'] . "<br>" . 
			"<b>Дата:</b> " . $date . " - " . GetWeekdayName($result['weekday']) . "<br>" . 
			"<b>Время:</b> " . $result['time'] . "<br><br>
			Если всё верно нажмите 'Далее'.";

			$form .= '<input type="hidden" name="stage" value="end">' . 
			'<input type="hidden" name="user" value="' .  $user_id . '">' . 
			'<input type="hidden" name="branch" value="' .  $branch_id . '">' . 
			'<input type="hidden" name="doc" value="' .  $doc_id . '">' .
			'<input type="hidden" name="bc" value="' .  $bc . '">' . 
			'<input type="hidden" name="date" value="' .  $date . '">' . 
			'<input type="hidden" name="visit" value="' .  $visit . '">';

			$form .= '<script>document.getElementById("back_button").style.display = "block";</script>';
			break;



		//________________________________________________________________________________END
		case 'end':
			$user_id = $_POST['user'];
			$visit = $_POST['visit'];

			$query = "UPDATE visits SET user = '$user_id' WHERE id = '$visit';";
			@mysqli_query($db, $query);

			$form = "Запись на приём прошла успено. 
			<script>
				window.location.reload(true);
			</script>";		
			break;
		
		default:
			break;
	}
	echo ($form);
?>