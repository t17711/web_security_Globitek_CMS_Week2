<?php
require_once '../../../private/initialize.php';
?>
<?php $page_title = 'Staff: New State'; ?>
<?php require SHARED_PATH . '/header.php'; ?>

<?php

$country_id=$_GET['country'];
if(!is_valid_id($country_id)) {
    redirect_to('index.php');
}


$country_obj=find_country_by_id($country_id);
$country = db_fetch_assoc($country_obj);

if($country['id']!=$country_id) {
    redirect_to('index.php');
}

$name = ['name', 'code','country_id'];
$value_title= ['Enter State Name: ','Enter Abbreviation Code: '];

$value =[];
$errors=[];

// No loop, only one result
$state = array_fill_keys($name, '');


$redirect =$_SERVER["PHP_SELF"]."?country=".$country['id'];

// process db value compare to post and update
if(is_post_request()) {
    $state['country_id'] = (int)$_GET['country']; // add country id for insert
    $result = process_post_request('insert_state', $name, $state, $errors);    
    if($result) {     
        $new_id = db_insert_id($db);    
        redirect_to('show.php?id=' . $new_id);
    }
}

// remove country id to display
unset($name['id']);

// now copy values to display
$state=array_map("h",$state); // html encode
foreach ($name as $key) {
    $value[]=$state[$key];
}

?>
<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>New State in <?php echo h($country['name']); ?></h1>

  <!-- TODO add form -->
    <?php 
           echo display_errors($errors); 
           echo input_area($value_title, $name, $value, $redirect)
        ?>
</div>

<?php require SHARED_PATH . '/footer.php'; ?>
