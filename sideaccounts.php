<div id="wrapper">

        <!-- Sidebar -->
		<?php
			$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Password = '".$password."'";
			$result8 = mysql_query($SQL);
			$row8 = mysql_fetch_array($result8);
			$name = $row8[0];
			
			$SQL = "SELECT COUNT(uh.UID) FROM uh, user WHERE uh.USERID = user.UID AND user.Name = '".$name."'";
			$result6 = mysql_query($SQL);
			$row6 = mysql_fetch_array($result6);
			$SQL = "SELECT COUNT(uoi.UID) FROM uoi, user WHERE uoi.UserID = user.UID AND user.Name = '".$name."'";
			$result7 = mysql_query($SQL);
			$row7 = mysql_fetch_array($result7);
			
			$SQL = "SELECT DISTINCT user.Name FROM user WHERE user.Name != '".$name."'";
			$result5 = mysql_query($SQL);
		?>
        <div id="sidebar-wrapper" style = "background: rgba(255, 255, 255, 1);margin-top:-0.2%;">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        All accounts
                    </a>
                </li>
				 <table style = "margin-left: 6%;">
				<thead>
				  <tr style = "background-color: #d0bf86; ">
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">HW </th>
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">INFO </th>
					<th colspan="1" style = "padding: 7px;text-align:center; font-weight: normal;">USERNAME</th>
				  </tr>
				</thead>
				<tbody>
				
				<?php
						
						
						echo '<tr style = "background-color: #dfd0a4;"><td><li><span style = "color:#d2700b;text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:#d2700b;text-align:center;">'.$row7[0].'</span></li></td><td><li><a href = "redirect.php?acc='.$name.'" style = "padding-right: 20px;text-align:center;">My wall</a></li></td></tr>';
					while ($row5 = mysql_fetch_array($result5)) {
						//echo "Name = ".$row[0];
						$SQL = "SELECT COUNT(uh.UID) FROM uh, user WHERE uh.USERID = user.UID AND user.Name = '".$row5[0]."'";
						$result6 = mysql_query($SQL);
						$row6 = mysql_fetch_array($result6);
						$SQL = "SELECT COUNT(uoi.UID) FROM uoi, user WHERE uoi.UserID = user.UID AND user.Name = '".$row5[0]."'";
						$result7 = mysql_query($SQL);
						$row7 = mysql_fetch_array($result7);
						echo '<tr style = "background-color: #e5dec6;"><td><li><span style = "color:#d2700b;text-align:center;">'.$row6[0].'</span></li></td><td><li><span style = "color:#d2700b;text-align:center;">'.$row7[0].'</span></li></td><td><li><a href="redirect.php?acc='.$row5[0].'" style = "padding-right: 20px;text-align:center;">'.$row5[0].' </a></li></td></tr>';
					}
				?>
				</tbody>
				</table>
            </ul>
        </div>
<div id="page-content-wrapper">