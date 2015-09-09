<div id="wrapper">

        <!-- Sidebar -->
		<?php
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
			
			$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Name != '".$name."' ORDER BY user.Name";
			$result5 = mysql_query($SQL);
		?>
        <div id="sidebar-wrapper" style = "background-color:#eeeeee;margin-top:-0.2%;">
            <ul class="sidebar-nav" style = "">
                <li class="sidebar-brand">
                    <a href="#" style = "color:#7a7574;">
                        Акаунти
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
						$color1 = "#837d7c";
						$color2 = "#d2c9c6";
						if (isset($name)) {
							echo '<tr style = "background-color: '.$color1.';"><td><li><span style = "color:'.$color2.';text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:'.$color2.';text-align:center;">'.$row7[0].'</span></li></td><td><li><a href = "redirect.php?acc='.$name.'" style = "padding-right: 20px;text-align:center;color:'.$color2.';">My wall</a></li></td></tr>';
						}
					while ($row5 = mysql_fetch_array($result5)) {
						//echo "Name = ".$row[0];
						$SQL = "SELECT COUNT(uh.UID) FROM uh, user, homeworks WHERE uh.USERID = user.UID AND user.Name = '".$row5[0]."' AND homeworks.UID = uh.HWID";
						
						$result6 = mysql_query($SQL);
						$row6 = mysql_fetch_array($result6);
						$SQL = "SELECT COUNT(uoi.UID) FROM uoi, user, otherinfo WHERE uoi.UserID = user.UID AND user.Name = '".$row5[0]."' AND otherinfo.UID = uoi.OtherInfoID";
						$result7 = mysql_query($SQL);
						$row7 = mysql_fetch_array($result7);
						echo '<tr style = "background-color: '.$color2.';"><td><li><span style = "color:'.$color1.';text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:'.$color1.';text-align:center;">'.$row7[0].'</span></li></td><td><li><a href="redirect.php?acc='.$row5[0].'" style = "padding-right: 20px;text-align:center;color:'.$color1.';">'.$row5[0].' </a></li></td></tr>';
					}
				?>
				</tbody>
				</table>
            </ul>
        </div>
<div id="page-content-wrapper">