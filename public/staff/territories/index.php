<?php require_once('../../../private/initialize.php'); ?>
<?php
if(!isset($_GET['state'])) {
  redirect_to('../states/index.php');
}
$id = $_GET['state'];

//echo $id;
redirect_to('../states/show.php?id='.$id);