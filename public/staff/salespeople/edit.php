<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

$name = ['first_name', 'last_name', 'phone','email'];
$value_title= ['Enter First Name: ','Enter Last Name: ','Enter Phone: ','Enter Email '];

$value =[];
$errors=[];

$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);

$redirect =$_SERVER["PHP_SELF"].'?id='.$salesperson['id'];

// process db value compare to post and update
if(is_post_request()) {
	$result = process_post_request('update_salesperson',$name, $salesperson, $errors);
	if($result){ 		
        redirect_to('show.php?id=' . $salesperson['id']);
	}
}

// now copy values to display
foreach ($name as $key) {
		$value[]=$salesperson[$key];
}



?>
<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>

  <!-- TODO add form -->
  <?php echo display_errors($errors); echo input_area($value_title, $name, $value,$redirect) ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
