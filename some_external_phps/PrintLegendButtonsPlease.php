<?php
  function PrintLegendButtonsPlease($TitlesArray,$MyHeading){
    $TitlesNum = count($TitlesArray);
    $TitlesCounter = 0;
    echo '<div style = "text-align:center;border:1px solid #c8ccc1;border-radius: 5px;padding: 4.5px;color: #243746;background-color: white;font-size:24;font-family:Arial	;font-weight: bold;">'.$MyHeading.'</div>';
    echo '<div class="btn-group btn-group-justified" role="group" style = "width:100%">';
    while($TitlesCounter<$TitlesNum){
      echo '<div class="btn-group" role="group">
        <button type="button" class="btn btn-default" style = "background: '.$TitlesArray[$TitlesCounter]["BGColor"].';border-color: #837d7c;border-width:3px;color:'.$TitlesArray[$TitlesCounter]["Color"].';">'.$TitlesArray[$TitlesCounter]["TEXT"].'</button>
      </div>';
      $TitlesCounter++;
    }
    echo '</div>';
  }

?>
