<?php
require_once('../../../private/initialize.php');
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
if(!isset($_GET['state'])) {
  redirect_to('index.php');
}

$state_obj=find_state_by_id($_GET['state']);
$state = db_fetch_assoc($state_obj);

if($state['id']!=$_GET['state']){
	 redirect_to('index.php');
}


$name = ['name', 'position','state_id'];
$value_title= ['Enter Territory Name: ','Enter Territory Position: '];

$value =[];
$errors=[];

// No loop, only one result
$territory = array_fill_keys($name, '');

$redirect =$_SERVER["PHP_SELF"]."?state=".$state['id'];

// process db value compare to post and update
if(is_post_request()) {
	$territory['state_id'] = (int)$state['id']; // add country id for insert
	$result = process_post_request('insert_territory',$name, $territory, $errors);	
	if($result){ 	
		$new_id = db_insert_id($db);	
        redirect_to('show.php?id=' . $new_id);
	}
}

// remove country id to display
unset($name['id']);
// now copy values to display
foreach ($name as $key) {
		$value[]=$territory[$key];
}

$state_id = $territory['state_id'];
?>
<div id="main-content">
  <a href="index.php?state=<?php echo $state_id?>">Back to State Details</a><br />

  <h1>New Territory</h1>

  <!-- TODO add form -->
  <?php 
   		echo display_errors($errors); 
   		echo input_area($value_title, $name, $value,$redirect)
   	?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
