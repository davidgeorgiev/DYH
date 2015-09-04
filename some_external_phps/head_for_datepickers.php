<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="Clean-jQuery-Date-Time-Picker-Plugin-datetimepicker/jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

</style>
<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="jquery/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="jquery/jquery.min.js"><\/script>\n')
        document.write('<script src="jquery/jquery-ui.min.js"><\/script>\n') 
    }
</script>
 
<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#pickdate').datepicker();
    })
}
</script>
</head>