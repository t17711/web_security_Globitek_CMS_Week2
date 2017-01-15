<?php
require_once('../../../private/initialize.php');
?>

<?php $page_title = 'Staff: New Salesperson'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
$name[] = 'first_name';
$name[] = 'last_name';
$name[] = 'phone';
$name[] = 'email';

$value_title[]='Enter First Name: ';
$value_title[]='Enter Last Name: ';
$value_title[]='Enter Phone: ';
$value_title[]='Enter Email ';

$value =[];
$errors=[];

$salesperson = array(
  'first_name' => '',
  'last_name' => '',
  'phone' => '',
  'email' => ''
);

$redirect =$_SERVER["PHP_SELF"]; // post redirect

// process db value compare to post and update
if(is_post_request()) {

  // Confirm that values are present before accessing them.
	foreach ($name as $key) {
		if(isset($_POST[$key])) {$salesperson[$key] = $_POST[$key]; }
	}
 
  	$result = insert_salesperson($salesperson);

  	if($result === true) {
  		$new_id = db_insert_id($db);
    	redirect_to('show.php?id=' . $new_id);
  	} 
  	else {
    	$errors = $result;
    	
  	}
 	
}

// now copy values to display
foreach ($name as $key) {
	$value[]=$salesperson[$key];
}





?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>New Salesperson</h1>

  <!-- TODO add form -->
   <?php 
   		echo display_errors($errors); 
   		echo input_area($value_title, $name, $value,$redirect)
   	?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
