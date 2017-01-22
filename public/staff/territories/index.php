<?php require_once '../../../private/initialize.php'; ?>
<?php
$state = $_GET['state'];
if(!is_valid_id($state)) {
    redirect_to('../states/index.php');
}

//echo $id;
redirect_to('../states/show.php?id='.$state);