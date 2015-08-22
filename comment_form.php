<form role="form" <?php echo 'action='; echo "comment_added.php";?> method="post">
<div class="form-group">
<label for="text">Описание</label>
<textarea type="text" cols="50" rows="3" class="form-control" name="comment" placeholder=""></textarea>
</div>
<?php
echo '<button class="btn btn-default" style = "width: 100%;background-color:white;" type="submit" >Коментирай</button>';
?>
</form>