<?php

echo $_FILES['fich1']['error']; echo "<br/>";
echo $_FILES['fich1']['name'];  echo "<br/>";
echo $_FILES['fich1']['tmp_name'];  echo "<br/>";
echo $_FILES['fich1']['size'];  echo "<br/>";
echo $_FILES['fich1']['type'];  echo "<br/>";

if (is_uploaded_file($_FILES['fich1']['tmp_name'])) {
  $target_path = "./uploads/"."up_".$_FILES['fich1']['name'];
  move_uploaded_file($_FILES['fich1']['tmp_name'], $target_path);
}

// list Files

$d = dir("./uploads/");

while($file = $d->read()) {
  echo '<img width="100" height="100" src="./uploads/'.$file.'"/>';
}

?>
