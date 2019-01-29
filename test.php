<?php

if(isset($_POST['file'])){
    $conn = new mysqli("localhhost","root","","test");
}

?>



<html>
<body>
<form action="test.php" method="post">
    <input type="file" name="file">
    <input type="submit" value="Upload">
</form>
</body>
</html>
