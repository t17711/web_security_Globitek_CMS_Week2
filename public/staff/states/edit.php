<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

$name = ['name', 'code'];
$value_title= ['Enter State Name: ','Enter Abbreviation Code: '];

$value =[];
$errors=[];

$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);

$redirect =$_SERVER["PHP_SELF"].'?id='.$state['id'];

// process db value compare to post and update
if(is_post_request()) {
	$result = process_post_request('update_state',$name, $state, $errors);	
	if($result){ 	
        redirect_to('show.php?id=' . $state['id']);
	}
}

// now copy values to display
foreach ($name as $key) {
		$value[]=$state[$key];
}


?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>Edit State: <?php echo $state['name']; ?></h1>

  <!-- TODO add form -->
<?php echo display_errors($errors); echo input_area($value_title, $name, $value,$redirect) ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
