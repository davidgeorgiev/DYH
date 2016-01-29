<style>

#SidePanelImg{
	border:solid white;
	margin-bottom:10px;
}

</style>
<div id="wrapper">

        <!-- Sidebar -->
		<?php
			include "some_external_phps/CountUnappreciatedHomeworks.php";
			include "some_external_phps/CountSuggestedHomeworks.php";
			include "some_external_phps/CountWaitingForHelp.php";
			$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Password = '".$password."'";
			$result8 = mysql_query($SQL);
			$row8 = mysql_fetch_array($result8);
			$name = $row8[0];

			$SQL = "SELECT COUNT(uh.UID) FROM uh, user, homeworks WHERE uh.USERID = user.UID AND user.Name = '".$name."' AND homeworks.UID = uh.HWID";
			$result6 = mysql_query($SQL);
			$row6 = mysql_fetch_array($result6);
			$SQL = "SELECT COUNT(uoi.UID) FROM uoi, user, otherinfo WHERE uoi.UserID = user.UID AND user.Name = '".$name."' AND otherinfo.UID = uoi.OtherInfoID";
			$result7 = mysql_query($SQL);
			$row7 = mysql_fetch_array($result7);

			$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Name != '".$name."' AND ((user.UID IN (SELECT friends.FirstPersonID FROM friends WHERE friends.FirstConfirm = 1 AND SecondConfirm = 1 AND ((friends.FirstPersonID = ".Get_Logged_users_id().") OR (friends.SecondPersonID = ".Get_Logged_users_id().")))) OR (user.UID IN (SELECT friends.SecondPersonID FROM friends WHERE friends.FirstConfirm = 1 AND SecondConfirm = 1 AND ((friends.FirstPersonID = ".Get_Logged_users_id().") OR (friends.SecondPersonID = ".Get_Logged_users_id()."))))) ORDER BY user.Name";
			//echo $SQL;
			$result5 = mysql_query($SQL);
		?>
        <div id="sidebar-wrapper" style = "background-color:#eeeeee;margin-top:-0.2%;">
            <ul class="sidebar-nav" style = "">
							<li class="sidebar-brand">
								<a href="helpsomebody.php?only_me=1" style = "color:#7a7574;font-family:Arial;font-size:15px;margin-left:-10px;">
								<span class = "glyphicon glyphicon-bullhorn"></span> Моите проблеми - <?php

								echo CountWaitingForHelp(Get_Logged_users_id());


								?>
								</a>
							</li>
                <li class="sidebar-brand">
                    <a href="fr_waiting_accept.php" style = "color:#7a7574;font-family:Arial;font-size:15px;margin-left:-10px;">
                        <span class = "glyphicon glyphicon-user"></span> Чакащи одобрение - <?php

							echo CountWaitingRequests(Get_Logged_users_id());


						?>
                    </a>
					</li>
					<li class="sidebar-brand">
					<a href="hws_waiting_assessment.php" style = "color:#7a7574;font-family:Arial;font-size:15px;margin-left:-10px;">
                        <span class = "glyphicon glyphicon-duplicate"></span> Решени за оценка - <?php

							echo CountUnappreciatedHomeworks(Get_Logged_users_id());


						?>
                    </a>
                </li>
				<li class="sidebar-brand">
					<a href="hws_waiting_confirmation.php" style = "color:#7a7574;font-family:Arial;font-size:15px;margin-left:-10px;">
                        <span class = "glyphicon glyphicon-duplicate"></span> Неодобрени домашни - <?php

							echo CountSuggestedHomeworks(Get_Logged_users_id());


						?>
                    </a>
                </li>
				 <table style = "margin-left: 6%;width:100%;margin-left:4px;">
				<thead>
				  <tr style = "background-color: #8f8a89; color:white; font-family:Arial;">
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">HW </th>
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">INFO </th>
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">USERNAME</th>
				  </tr>
				</thead>
				<tbody>

				<?php
						$UserInfo = ReturnALLUserInfoByIdOrByName($name);
						$color1 = "#837d7c";
						$color2 = "#d2c9c6";
						if (isset($name)) {
							echo '<tr style = "background-color: '.$color1.';"><td><li><span style = "color:'.$color2.';text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:'.$color2.';text-align:center;">'.$row7[0].'</span></li></td><td><li><a href = "redirect.php?acc='.$name.'" style = "padding-right: 20px;text-align:center;color:'.$color2.';">'.$UserInfo["FirstName"]." ".$UserInfo["LastName"].'<div><img id = "SidePanelImg" src="'.$UserInfo["IMGURL"].'" width = "100px" height = "100px"/></div></a></li></td></tr>';
						}
					while ($row5 = mysql_fetch_array($result5)) {
						$UserInfo = ReturnALLUserInfoByIdOrByName($row5[0]);
						//echo "Name = ".$row[0];
						$SQL = "SELECT COUNT(uh.UID) FROM uh, user, homeworks WHERE uh.USERID = user.UID AND user.Name = '".$row5[0]."' AND homeworks.UID = uh.HWID";

						$result6 = mysql_query($SQL);
						$row6 = mysql_fetch_array($result6);
						$SQL = "SELECT COUNT(uoi.UID) FROM uoi, user, otherinfo WHERE uoi.UserID = user.UID AND user.Name = '".$row5[0]."' AND otherinfo.UID = uoi.OtherInfoID";
						$result7 = mysql_query($SQL);
						$row7 = mysql_fetch_array($result7);
						echo '<tr style = "background-color: '.$color2.';"><td><li><span style = "color:'.$color1.';text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:'.$color1.';text-align:center;">'.$row7[0].'</span></li></td><td><li><a href="redirect.php?acc='.$row5[0].'" style = "padding-right: 20px;text-align:center;color:'.$color1.';">'.$UserInfo["FirstName"]." ".$UserInfo["LastName"].' <div><img id = "SidePanelImg" src="'.$UserInfo["IMGURL"].'" width = "100px" height = "100px"/></div></a></li></td></tr>';
					}
				?>
				</tbody>
				</table>
            </ul>
        </div>
<div id="page-content-wrapper">
