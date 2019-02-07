<?php



echo $_POST['na'];
echo $_POST['fi'];



?>



<html>
<body>
<form action="test.php" method="post" enctype="multipart/form-data">
    <input type="text"  name="na">
    <input type="file"  name="fi">
    <input type="submit" value="Test">
</form>
</body>
</html>
