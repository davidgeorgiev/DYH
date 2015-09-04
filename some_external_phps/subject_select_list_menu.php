<?php
	if ($theresnosubjects == 1) {
		echo '<label for="text">Нямате предмети създайте от опциите горе в менюто!</label>';
	} else {
		//echo '<label for="text">Изберете от вашия списък с предмети!</label>';
		echo '<select class="form-control" name="'.$name.'">';
		echo '<option value="">Изберете предмет</option>';
		for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
			$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
			$result = mysql_query($SQL);
			$row = mysql_fetch_array($result);
			echo '<option value="'.$row[0].'">'.$row[0].'</option>';
		}
		echo '</select>';
	}
  ?>