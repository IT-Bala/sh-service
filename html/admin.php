<p align="center">Welcome to SH Panel</p>
<form method="post">
    <p>Type:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="type"><?php foreach($types as $type){?><option value="<?php echo $type;?>" <?=(isset($_POST['type']) && $_POST['type']==$type)?'selected':''?>><?php echo ucfirst($type);?></option><?php }?></select>
	<p>Title:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" value="<?=(isset($_POST['title']))?$_POST['title']:''?>"></p>
	<p>Content: <textarea name="content" cols="30"><?=(isset($_POST['content']))?$_POST['content']:''?></textarea></p>
	<textarea hidden="hidden" name="routes"><?=$urls?></textarea>
	<input type="submit" name="save" value="Save" />
</form>


