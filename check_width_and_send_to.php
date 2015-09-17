<?php
	session_start();
	$_SESSION['page'] = 'check_width';
?>
<script type="text/javascript">

if (screen.width < screen.height){
	width = screen.width;
	height = screen.height;
} else {
	width = window.innerWidth;
	height = window.innerHeight;
}
function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
	if (width > 0 && height >0) {
		window.location.href = getQueryVariable("page")+".php?user="+getQueryVariable("user")+"&width=" + width + "&height=" + height + "&hwid=" + getQueryVariable("hwid") + "&weeknum=" + getQueryVariable("weeknum") + "&numofweeks=" + getQueryVariable("numofweeks") + "&time_period=" + getQueryVariable("time_period") + "&searching_for=" + getQueryVariable("searching_for") + "&suggest_to=" + getQueryVariable("suggest_to");
	} else;
		exit();
</script>