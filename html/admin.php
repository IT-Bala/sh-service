<p align="center">Welcome to SH Panel</p>
<form method="post">
    <p>Type:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="type"><?php foreach($types as $type){?><option value="<?php echo $type;?>"><?php echo ucfirst($type);?></option><?php }?></select>
	<p>Title:   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title"></p>
	<p>Content: <textarea name="content" cols="30"></textarea></p>
	<input type="submit" name="save" value="Save" />
</form>


