<form role="form" <?php echo 'action='; echo "comment_added.php";?> method="post">
<div class="form-group">
<label for="text" style = "color:#d2c9c6;">Описание</label>
<textarea type="text" cols="50" rows="3" class="form-control" name="comment" placeholder="" style = "background-color:#746f6e;color:white;"></textarea>
</div>
<?php
echo '<button class="btn btn-default" style = "width: 100%;background:#837d7c;color:#d2c9c6" type="submit" >Коментирай</button>';
?>
</form>