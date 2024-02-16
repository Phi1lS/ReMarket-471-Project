<?php
    require_once "pdo.php";
    if(isset($_POST['user_id']) ) {
        $sql="DELETE FROM users WHERE user_id = :zip";
        echo "<pre>\n$sql\n</pre\n";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip'=>$_POST['user_id']));
    }
?>
<p>Delete a user</p>
<form method="post"><p>ID to Delete:
    <input type="text" name="user_id"></p>
    <p><input type="sumbit" value="Delete"/></p>
</form>