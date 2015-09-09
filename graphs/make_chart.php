<!-- Load c3.css -->
<link href="c3.css" rel="stylesheet" type="text/css">
<!-- Load d3.js and c3.js 

<script src="d3.min.js" charset="utf-8"></script>
<script src="c3.min.js"></script>

-->

<script src="graphs/lib/js/jquery.min.js"></script>
<script src="graphs/lib/js/chartphp.js"></script>
<link rel="stylesheet" href="graphs/lib/js/chartphp.css">
<?php
	include("lib/inc/chartphp_dist.php");
	function MakeMyChart($MyFinalArray, $label, $type, $chartname){
		$p = new chartphp();
		$p->data = $MyFinalArray;
		$p->chart_type = $type;

		// Common Options
		$p->title = "";
		$p->ylabel = $label;
		//$p->series_label = array('Q1','Q2'); 
		$p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '';

		return $p->render($chartname);
	}
?>