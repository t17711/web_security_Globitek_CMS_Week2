<?php
require_once '../../../private/initialize.php';
?>
<?php $page_title = 'Staff: New Salesperson'; ?>
<?php require SHARED_PATH . '/header.php'; ?>
<?php
$name = ['first_name', 'last_name', 'phone','email'];
$value_title= ['Enter First Name: ','Enter Last Name: ','Enter Phone: ','Enter Email '];
$redirect =$_SERVER["PHP_SELF"]; // post redirect
$salesperson = array_fill_keys($name, '');
$value =[];
$errors=[];
// process db value compare to post and update
if(is_post_request()) { 
    $result = process_post_request('insert_salesperson', $name, $salesperson, $errors); 

    if($result) { 
        $new_id = db_insert_id($db); 
        redirect_to('show.php?id=' . $new_id); 
    }
}
// now copy values to display

$salesperson = array_map("h", $salesperson);
// now copy values to display
foreach ($name as $key) {
    $value[]= $salesperson[$key];
}

?>
<div id="main-content"> <a href="index.php">Back to Salespeople List</a><br /> <h1>New Salesperson</h1> 
<!-- TODO add form -->
 <?php echo display_errors($errors); 
 echo input_area($value_title, $name, $value, $redirect) ?>
</div>
<?php require SHARED_PATH . '/footer.php'; ?>