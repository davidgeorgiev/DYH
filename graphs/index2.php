<?php
/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.1
 * @license: see license.txt included in package
 */
 include("lib/inc/chartphp_dist.php");
 $p = new chartphp();
 

//$dates_array and $daily_rank_sum_arr
$dates_array = array("1","2","3");
$daily_rank_sum_arr = array("1","2","3");

$done_array = array();


for ($i = 0;$i < sizeof($dates_array);$i++){
	array_push($done_array,(array($dates_array[$i],$daily_rank_sum_arr[$i])));
}
$p->data = array($done_array);

$p->chart_type = "line";

// Common Options
$p->title = "";
$p->ylabel = "Напрегнатост";
$p->series_label = array("1","2");

$p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '';

$out = $p->render('c1');

//print_r ($done_array);

?>
<html>
<head>
        <script src="lib/js/jquery.min.js"></script>
        <script src="lib/js/chartphp.js"></script>
        <link rel="stylesheet" href="lib/js/chartphp.css">
    </head>
    <body>
        <div style="width:40%; min-width:450px;">
            <?php echo $out; ?>
        </div>
</body>
</html>
