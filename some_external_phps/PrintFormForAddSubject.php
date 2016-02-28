<div style = " margin: auto;width: 98%;border-radius:10px;border:3px solid #d2c9c6;background-color:#837d7c;padding: 10px;">
<form id="subject_input" role="form" <?php echo 'action='; echo "subjects_added.php?user=".$username?> method="post">
     <div id="dynamicInput">
          <br> <br/><div class="form-group" style = "color:white;"><label for="text">Предмет 1</label><input type="text" class="form-control" name="myInputs[]" placeholder="Въведете името на предмета тук"><label for="text">Любимост</label><select class="form-control" name="myRanks[]"><?php for ($i = 1; $i <=10; $i++) {echo '<option value="'.$i.'">';$rank_of_subject = $i;include "subject_scale_to_words.php";echo $rank_of_subject_with_words."</option>";}?></select></div>
     </div>
	 <p>Внимание веднъж въведен предмет не може да се изтрива или редактира!</p>
     <input type="button" class="btn btn-default" value="Още един" onClick="addInput('dynamicInput');">


	 <?php
	 if ($EditMode == 1) {
		echo '<button type="submit" class="btn btn-default">Запази</button>';
	 }
	 ?>


</form>
</div>
