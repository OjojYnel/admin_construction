<?php
date_default_timezone_set('Asia/Manila');
$a = date('h-i-a');


?>



<html>
<body>
<form action="test.php" method="post">
    <input type="time" min="22:00:00" max="23:00:00" name="ti">
    <input type="submit" value="Test">
</form>
</body>
</html>
