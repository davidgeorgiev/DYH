<?php
	function MakeSubjectMenu($username, $nameforform){
		$SQL = "SELECT COUNT(usersubjectlist.UID) FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);

		$theresnosubjects = 0;
		if ($row[0] <= 0) {
			$theresnosubjects = 1;
		} else {
			$SQL = "SELECT usersubjectlist.SUBJECTLISTID FROM usersubjectlist, user WHERE usersubjectlist.USERID = user.UID AND user.Name = '".$username."'";
			//echo $SQL;
			$result = mysql_query($SQL);
			$row = mysql_fetch_array($result);
			//echo "<p>".$row[0]."</p>";
			$subject_ids_arr = explode(",", $row[0]);
		}
		if ($theresnosubjects == 1) {
			echo '<label for="text">Нямате предмети създайте от опциите горе в менюто!</label>';
		} else {
			//echo '<label for="text">Изберете от вашия списък с предмети!</label>';
			echo '<select class="form-control" name="'.$nameforform.'">';
			echo '<option value="0">Изберете предмет</option>';
			for ($i = 0;$i < sizeof($subject_ids_arr) - 1; $i++) {
				$SQL = "SELECT subjects.Name, subjects.Rank FROM subjects WHERE subjects.UID = ".$subject_ids_arr[$i];
				$result = mysql_query($SQL);
				$row = mysql_fetch_array($result);
				echo '<option value="'.$subject_ids_arr[$i].'">'.$row[0].'</option>';
			}
			echo '</select>';
		}
		return $theresnosubjects;
	}
  ?>