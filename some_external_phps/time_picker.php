<?php
	//echo '<label for="text">Изберете от вашия списък с предмети!</label>';
	echo "<div>";
	echo '<select style = "float:left;width:50%" class="form-control" name="'.$name.'">';
	echo '<option value="00">Час</option>';
	for ($i = 6;$i <= 21; $i++) {
		if ($i < 10){
			$temp_str = "0";
		} else {
			$temp_str = "";
		}
		echo '<option value="'.$temp_str.$i.'">'.$temp_str.$i.'</option>';
	}
	echo '</select>';
	echo '<select style = "float:left;width:50%" class="form-control" name="'.$name2.'">';
	echo '<option value="00">Минути</option>';
	for ($i = 0;$i <= 59; $i+=5) {
		if ($i < 10){
			$temp_str = "0";
		} else {
			$temp_str = "";
		}
		echo '<option value="'.$temp_str.$i.'">'.$temp_str.$i.'</option>';
	}
	echo '</select>';
	echo "</div>";
  ?>