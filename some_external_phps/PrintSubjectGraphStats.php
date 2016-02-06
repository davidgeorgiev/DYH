<?php
  include "ShowSubjectStatistics.php";
  include "PrintLegendButtonsPlease.php";
  include "GetSubjectNameByID.php";
  function FixMyArrayPleaseToBeGoodForMakeAGraph($MyUserAverageSubjectStatisticsMonths){
    $MyUserAverageSubjectStatisticsMonthsFixed = array();
    $AssessmentArray = array();
    $StatsArray = array();
    $ArraySize = count($MyUserAverageSubjectStatisticsMonths);
    $monthCounter = 0;
    $AssessmentCounter = 0;
    while ($monthCounter < $ArraySize){
      if ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][1]>0){
        $AssessmentArray[$AssessmentCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $AssessmentArray[$AssessmentCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][1];
        $AssessmentCounter++;
      }
      $monthCounter++;
    }
    $MyUserAverageSubjectStatisticsMonthsFixed[0] = $AssessmentArray;
    $monthCounter = 0;
    $SolvingsCounter = 0;
    while ($monthCounter < $ArraySize){
      if ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["NumOfSolvings"]>0){
        $StatsArray["NumOfSolvings"][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["NumOfSolvings"][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["NumOfSolvings"]; //брой решавания за месец

        $StatsArray["NumOfAssessments"][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["NumOfAssessments"][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["NumOfAssessments"]; //бройка на оценките за месец



        //array(array(array("January 2016",5),array("February 2016",3)),array(array("January 2016",2),array("February 2016",6)),array(array("January 2016",4),array("February 2016",12)))
        //$StatsArray["Sums"] = array();

        $StatsArray["Sums"][0][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][0][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][0]; //сума от отделеното време в часове

        $StatsArray["Sums"][1][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][1][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][1]; //сума от оценките за месец

        $StatsArray["Sums"][2][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][2][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][2]; //сума от ентусиазма на ученика за месец

        $StatsArray["Sums"][3][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][3][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][3]; //сума от дължината в страници за месец

        $StatsArray["Sums"][4][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][4][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][4]; //сума от наученото за месец

        $StatsArray["Sums"][5][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Sums"][5][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][5]; //сума от преписването за месец

        $StatsArray["Average"][0][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][0][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][0]; //Средно аритметично от отделеното време в часове

        $StatsArray["Average"][1][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][1][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][1]; //Средно аритметично от оценките за месец

        $StatsArray["Average"][2][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][2][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][2]; //Средно аритметично от ентусиазма на ученика за месец

        $StatsArray["Average"][3][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][3][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][3]; //Средно аритметично от дължината в страници за месец

        $StatsArray["Average"][4][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][4][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][4]; //Средно аритметично от наученото за месец

        $StatsArray["Average"][5][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["Average"][5][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][5]; //Средно аритметично от преписванета за месец

        $StatsArray["MixedSimplifiedInPercentView"][0][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][0][$SolvingsCounter][1] = ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Sums"][0]*100)/3.75; //Средно аритметично от отделеното време в проценти като за 100% е взето 3 часа и 45 минути ТЪМНО-СИНьО

        $StatsArray["MixedSimplifiedInPercentView"][1][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][1][$SolvingsCounter][1] = ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][1]*100)/6; //Средно аритметично от оценките за месец взето в проценти спрямо 6 ТЪМНО-ЗЕЛЕНО

        $StatsArray["MixedSimplifiedInPercentView"][2][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][2][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][2]; //Средно аритметично от ентусиазма на ученика за месец ОРАНЖЕВО

        $StatsArray["MixedSimplifiedInPercentView"][3][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][3][$SolvingsCounter][1] = ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][3]*100)/4.5; //Средно аритметично от дължината в страници за месец за 100% са взети 4 страници и половина СВЕТЛО-СИНьО

        $StatsArray["MixedSimplifiedInPercentView"][4][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][4][$SolvingsCounter][1] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][4]; //Средно аритметично от наученото за месец ЛИЛАВО

        if ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][5] <= 0){
  				$MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][5] = 0;
  			}
  			if ($MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][5] > 0){
  				$MyCheating = ((5-$MyUserAverageSubjectStatisticsMonths[$monthCounter][1]["Average"][5])*20);
  			} else {
  				$MyCheating = 0;
  			}

        $StatsArray["MixedSimplifiedInPercentView"][5][$SolvingsCounter][0] = $MyUserAverageSubjectStatisticsMonths[$monthCounter][0];
        $StatsArray["MixedSimplifiedInPercentView"][5][$SolvingsCounter][1] = $MyCheating; //Средно аритметично от преписванета за месец взето в процентна мярка СВЕТЛО-ЗЕЛЕНО

        if($StatsArray["MixedSimplifiedInPercentView"][0][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][0][$SolvingsCounter][1]=100;
        }
        if($StatsArray["MixedSimplifiedInPercentView"][1][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][1][$SolvingsCounter][1]=100;
        }
        if($StatsArray["MixedSimplifiedInPercentView"][2][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][2][$SolvingsCounter][1]=100;
        }
        if($StatsArray["MixedSimplifiedInPercentView"][3][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][3][$SolvingsCounter][1]=100;
        }
        if($StatsArray["MixedSimplifiedInPercentView"][4][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][4][$SolvingsCounter][1]=100;
        }
        if($StatsArray["MixedSimplifiedInPercentView"][5][$SolvingsCounter][1]>100){
          $StatsArray["MixedSimplifiedInPercentView"][5][$SolvingsCounter][1]=100;
        }

        $SolvingsCounter++;
      }
      $monthCounter++;
    }
    //$MyUserAverageSubjectStatisticsMonthsFixed[1] = array($StatsArray["NumOfSolvings"][0],$StatsArray["NumOfSolvings"][1]);
    $MyUserAverageSubjectStatisticsMonthsFixed[1] = array($StatsArray["Sums"][0],$StatsArray["Sums"][1],$StatsArray["Sums"][2],$StatsArray["Sums"][3],$StatsArray["Sums"][4],$StatsArray["Sums"][5]);
    $MyUserAverageSubjectStatisticsMonthsFixed[2] = array($StatsArray["Average"][0],$StatsArray["Average"][1],$StatsArray["Average"][2],$StatsArray["Average"][3],$StatsArray["Average"][4],$StatsArray["Average"][5]);
    $MyUserAverageSubjectStatisticsMonthsFixed[3] = array($StatsArray["MixedSimplifiedInPercentView"][0],$StatsArray["MixedSimplifiedInPercentView"][1],$StatsArray["MixedSimplifiedInPercentView"][2],$StatsArray["MixedSimplifiedInPercentView"][3],$StatsArray["MixedSimplifiedInPercentView"][4],$StatsArray["MixedSimplifiedInPercentView"][5]);
    $MyUserAverageSubjectStatisticsMonthsFixed[4] = array($StatsArray["Sums"][0],$StatsArray["Sums"][1],$StatsArray["Sums"][5]);
    $MyUserAverageSubjectStatisticsMonthsFixed[5] = array($StatsArray["Average"][0],$StatsArray["Average"][1],$StatsArray["Average"][5]);
    $MyUserAverageSubjectStatisticsMonthsFixed[6] = array($StatsArray["Sums"][2],$StatsArray["Sums"][3],$StatsArray["Sums"][4]);
    $MyUserAverageSubjectStatisticsMonthsFixed[7] = array($StatsArray["Average"][2],$StatsArray["Average"][3],$StatsArray["Average"][4]);
    $MyUserAverageSubjectStatisticsMonthsFixed[8] = array($StatsArray["NumOfSolvings"],$StatsArray["NumOfAssessments"]);
    return $MyUserAverageSubjectStatisticsMonthsFixed;
  }
  function MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID){ #The val $StartDate will be used for get the month not the day!!!
    $MyUserAverageSubjectStatisticsMonths = array();
    $monthCounter = 0;
    $d = new DateTime($FinalDate);
    $d->modify('first day of next month');
    $FinalDate = $d->format('F Y');
    $d = new DateTime($StartDate);
    $d->modify('first day of this month');
    $StartDate = $d->format('F Y');
    while (date('Y-m-01', strtotime($StartDate))!=date('Y-m-01', strtotime($FinalDate))){
      $BeginDate = date('Y-m-01', strtotime($StartDate));
      $LastDate = date('Y-m-t', strtotime($StartDate));

      //echo "<p>ReturnAverageStatisticsForUserSubject(".$UserID.",".$subjectID.",".$BeginDate.",".$LastDate.")</p>";
      $MyUserAverageSubjectStatisticsMonths[$monthCounter] = array($StartDate,ReturnAverageStatisticsForUserSubject($UserID, $subjectID, $BeginDate, $LastDate));
      //echo "<p>Stats from ".$BeginDate." to ".$LastDate." ";
      //print_r($MyUserAverageSubjectStatisticsMonths[$monthCounter]);echo"</p>";
      $d = new DateTime($StartDate);
      $d->modify('first day of next month');
      $StartDate = $d->format('F Y');
      $monthCounter++;
    }
    //print_r($MyUserAverageSubjectStatisticsMonths);
    $MyUserAverageSubjectStatisticsMonths = FixMyArrayPleaseToBeGoodForMakeAGraph($MyUserAverageSubjectStatisticsMonths);
    return $MyUserAverageSubjectStatisticsMonths;
  }
  function MakeSubjectAreaChart($MyUserAverageSubjectStatisticsMonthsFixed,$subjectID,$name_of_chart,$titlePart){


    $p = new chartphp();

    $p->data = $MyUserAverageSubjectStatisticsMonthsFixed;
    $p->chart_type = "line";

    //print_r(array(array(array('Време',$MyUserAverageSubjectStatisticsMonths["TimeForSolve"]), array('Оценка',$MyUserAverageSubjectStatisticsMonths["Assessment"]), array('Мнение',$MyUserAverageSubjectStatisticsMonths["PleasureInPercents"]), array('Дължина',$MyUserAverageSubjectStatisticsMonths["LengthInPages"]), array('Научено',$MyUserAverageSubjectStatisticsMonths["LearnedInPercents"]), array('Честност',$MyUserAverageSubjectStatisticsMonths["IfCheating"]))));
    // Common Options
    //$p->title = "Графика на ".$titlePart." по ".$MySubjectName[0];

    return $p->render($name_of_chart);
  }

  function PrintSubjectGraphStats($subjectID,$StartDate,$FinalDate,$UserID){
    $LegendColorsArray = array(0 => array("Color" => "white","BGColor" => "#008ee4"),array("Color" => "white","BGColor" => "#6baa01"),array("Color" => "white","BGColor" => "#e44a00"),array("Color" => "white","BGColor" => "#32bbd7"),array("Color" => "white","BGColor" => "#583e78"),array("Color" => "white","BGColor" => "#91d100"));
    $divForGraph = '<div style="margin-bottom:100px;margin-left:35px;width:100%;height:60%;min-width:100px;">'; //Принтиране на графиката за оценки
    $button_to_render = '<div><div class="dropdown" style = "float:right;padding-right:0px;">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:45px;font-size:20px;">
      <span class="glyphicon glyphicon-wrench"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption=assessments&user='.GetUserNamebyID($UserID).'&period='.$_GET["period"].'"><span class="glyphicon glyphicon-star-empty"></span> Решавания и оценки по '.GetSubjectNameByID($subjectID).'</a></li>
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption=percents&user='.GetUserNamebyID($UserID).'&period='.$_GET["period"].'"><span class="glyphicon glyphicon-tasks"></span> Процентна графика по '.GetSubjectNameByID($subjectID).'</a></li>
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption=sums&user='.GetUserNamebyID($UserID).'&period='.$_GET["period"].'"><span class="glyphicon glyphicon-plus-sign"></span> Графика на сумите по '.GetSubjectNameByID($subjectID).'</a></li>
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption=average&user='.GetUserNamebyID($UserID).'&period='.$_GET["period"].'"><span class="glyphicon glyphicon-stats"></span> Средно аритметично по '.GetSubjectNameByID($subjectID).'</a></li>
      </ul></div></div>';

    $button_to_render2 = '<div><div class="dropdown" style = "float:right;padding-right:0px;">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style = "width:60px;height:45px;font-size:20px;">
      <span class="glyphicon glyphicon-indent-left"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption='.$_GET["ShowOption"].'&user='.GetUserNamebyID($UserID).'&period=year"><span class="glyphicon glyphicon-resize-horizontal"></span> За годината</a></li>
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption='.$_GET["ShowOption"].'&user='.GetUserNamebyID($UserID).'&period=firstsemester"><span class="glyphicon glyphicon-import"></span> За първи срок</a></li>
      <li><a href="SubjectStatsAndGraphs.php?SubjectID='.$subjectID.'&ShowOption='.$_GET["ShowOption"].'&user='.GetUserNamebyID($UserID).'&period=secondsemester"><span class="glyphicon glyphicon-export"></span> За втори срок</a></li>
      </ul></div></div>';
    $button_to_render3 = '<a href="check_width_and_send_to.php?user='.GetUserNamebyID($UserID).'&page=update_subject_list'.'"><button style = "width:20%;height:45px;float:left;" class="btn btn-default"><span class = "glyphicon glyphicon-triangle-left"></span> Назад</button></a>';
      $MyGraphPartOfLabel = "";
      if($_GET["period"]=="year"){
        $MyGraphPartOfLabel = "годината";
      }else if($_GET["period"]=="firstsemester"){
        $MyGraphPartOfLabel = "първия срок";
      }else if($_GET["period"]=="secondsemester"){
        $MyGraphPartOfLabel = "втория срок";
      }

      echo $button_to_render3;
      echo $button_to_render;
      echo $button_to_render2;
      if ($_GET["ShowOption"]=="assessments"){
        $TitlesArray = array(0 => array("Color" => "white","BGColor" => "#008ee4","TEXT" => "Оценки"));
        PrintLegendButtonsPlease($TitlesArray,"Графика на оценките по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID);
        echo MakeSubjectAreaChart(array(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[0]),$subjectID,"c0");
        echo '</div>';

        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Количество решавания"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Брой на оценките"));
        PrintLegendButtonsPlease($TitlesArray,"Решавания и оценки по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[8],$subjectID,"c8");
  	    echo '</div>';
      }else if($_GET["ShowOption"]=="percents"){
        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Време"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Оценка"),array("Color" => $LegendColorsArray[2]["Color"],"BGColor" => $LegendColorsArray[2]["BGColor"],"TEXT" => "Ентусиазъм"),array("Color" => $LegendColorsArray[3]["Color"],"BGColor" => $LegendColorsArray[3]["BGColor"],"TEXT" => "Дължина"),array("Color" => $LegendColorsArray[4]["Color"],"BGColor" => $LegendColorsArray[4]["BGColor"],"TEXT" => "Научено"),array("Color" => $LegendColorsArray[5]["Color"],"BGColor" => $LegendColorsArray[5]["BGColor"],"TEXT" => "Преписване"));
        PrintLegendButtonsPlease($TitlesArray,"Процентна графика по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[3],$subjectID,"c3");
      	echo '</div>';
      }else if($_GET["ShowOption"]=="sums"){
        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Време"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Оценка"),array("Color" => $LegendColorsArray[2]["Color"],"BGColor" => $LegendColorsArray[2]["BGColor"],"TEXT" => "Преписване"));
        PrintLegendButtonsPlease($TitlesArray,"Графика на сумите по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[4],$subjectID,"c4");
  		  echo '</div>';

        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Ентусиазъм"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Дължина"),array("Color" => $LegendColorsArray[2]["Color"],"BGColor" => $LegendColorsArray[2]["BGColor"],"TEXT" => "Научено"));
        PrintLegendButtonsPlease($TitlesArray,"Графика на сумите по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[6],$subjectID,"c6");
  		  echo '</div>';
      }else if($_GET["ShowOption"]=="average"){
        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Време"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Оценка"),array("Color" => $LegendColorsArray[2]["Color"],"BGColor" => $LegendColorsArray[2]["BGColor"],"TEXT" => "Преписване"));
        PrintLegendButtonsPlease($TitlesArray,"Средно аритметично по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[5],$subjectID,"c5");
  	    echo '</div>';

        $TitlesArray = array(0 => array("Color" => $LegendColorsArray[0]["Color"],"BGColor" => $LegendColorsArray[0]["BGColor"],"TEXT" => "Ентусиазъм"),array("Color" => $LegendColorsArray[1]["Color"],"BGColor" => $LegendColorsArray[1]["BGColor"],"TEXT" => "Дължина"),array("Color" => $LegendColorsArray[2]["Color"],"BGColor" => $LegendColorsArray[2]["BGColor"],"TEXT" => "Научено"));
        PrintLegendButtonsPlease($TitlesArray,"Средно аритметично по ".GetSubjectNameByID($subjectID)." за ".$MyGraphPartOfLabel);
        echo $divForGraph;
        $myArr = array(array(array("first",5),array("second",6),array("third",3)));
        //print_r(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$UserID,$subjectID)[0]);
        echo MakeSubjectAreaChart(MakeMyUserAverageSubjectStatisticsMonthsArray($StartDate,$FinalDate,$subjectID,$UserID)[7],$subjectID,"c7");
  	    echo '</div>';
      }
  }

?>
