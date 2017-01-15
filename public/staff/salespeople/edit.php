<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);

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


// process db value compare to post and update
if(is_post_request()) {
  // Confirm that values are present before accessing them.
	foreach ($name as $key) {
		if(isset($_POST[$key])) { $salesperson[$key] = $_POST[$key]; }
	}
 
  $result = update_salesperson($salesperson);
  if($result === true) {
    redirect_to('show.php?id=' . $salesperson['id']);
  } else {
    $errors = $result;
  }

}
// now copy values to display
	foreach ($name as $key) {
		$value[]=$salesperson[$key];

}

$redirect =$_SERVER["PHP_SELF"].'?id='.$salesperson['id'];

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
