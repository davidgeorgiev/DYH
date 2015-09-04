<?php
	session_start();
	$_SESSION['page'] = 'check_whidth';
?>
<script type="text/javascript">

width = window.innerWidth;
height = window.innerHeight;

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
    window.location.href = "update_subject_list.php?user="+getQueryVariable("user")+"&width=" + width + "&height=" + height;
} else 
    exit();

</script>