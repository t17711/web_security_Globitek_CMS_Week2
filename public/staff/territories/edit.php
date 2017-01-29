<?php
require_once '../../../private/initialize.php';

$id=$_GET['id'];
if(!is_valid_id($id)) {
    redirect_to('index.php');
}

$territories_result = find_territory_by_id($id);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);
$state_id = $territory['state_id'];
$cur_name= h($territory['name']);

$name = ['name', 'position','state_id'];
$value_title= ['Enter Territory Name: ','Enter Territory Position: '];

$value =[];
$errors=[];

$redirect =$_SERVER["PHP_SELF"].'?id='.$territory['id'];

// process db value compare to post and update
if(is_post_request()) {
    $result = process_post_request('update_territory', $name, $territory, $errors);    
    if($result) {     
        redirect_to('show.php?id=' . $territory['id']);
    }
}

// now copy values to display
$territory=array_map("h",$territory);
foreach ($name as $key) {
    $value[]=$territory[$key];
}


?>
<?php $page_title = 'Staff: Edit Territory ' . $cur_name; ?>
<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">
  <a href="index.php?state=<?php echo $state_id?>">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo $cur_name; ?></h1>

  <!-- TODO add form -->
<?php echo display_errors($errors); echo input_area($value_title, $name, $value, $redirect) ?>

</div>

<?php require SHARED_PATH . '/footer.php'; ?>
