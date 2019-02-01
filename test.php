<?php

if(isset($_POST['ti'])){
    echo $_POST['ti'];
}

?>



<html>
<body>
<form action="test.php" method="post">
    <input type="time" name="ti">
    <input type="submit" value="Test">
</form>
</body>
</html>
