<?php
	include_once('dbConfig.php');
 
	if( isset($_GET['edit']) )
	{
		$id = $_GET['edit'];
		$res = $db->query("SELECT id, title, duration, location FROM events WHERE id='$id'");
		$row = $res->fetch_assoc();
	}
	
	if(isset($_POST['newTitle']))
	{
	    $newTitle = $_POST['newTitle'];
	    $id = $_POST['id'];
	    $sql = "UPDATE events SET title='newTitle' WHERE id='$id'";
        $res = $db->query($sql);
	    if($res){
		echo "<meta http-equiv='refresh' content='0;url=timetable.php'>";
	    }else{
		echo 'error';
    	}
	    }
	
?>

<form action="edit.php" method="POST">
    ID: <input type="hidden" name="id" value="<?php echo $row['id'];?>"><br/>
    Title: <input type="text" name="newTitle" value="<?php echo $row['title'];?>">
    <input type="submit" value=" Update "/>
</form>