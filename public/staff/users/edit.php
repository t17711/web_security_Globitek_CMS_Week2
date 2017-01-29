<?php

require_once '../../../private/initialize.php'; $id=$_GET['id']; if(!is_valid_id($id)) {     redirect_to('index.php'); }

$users_result = find_user_by_id($id);
// No loop, only one result
$user = db_fetch_assoc($users_result);

$name = ['first_name', 'last_name', 'username','email'];
$cur_name = h($user['first_name']. " " . $user['last_name'] );

$value_title =['Enter First Name: ', 'Enter Last Name: ','Enter Username: ','Enter Email: '];

$value =[];
$errors=[];

$redirect =$_SERVER["PHP_SELF"].'?id='.$user['id'];

// Set default values for all variables the page needs.
$errors = array();

if(is_post_request()) {
    // Confirm that values are present before accessing them.
   
    $result = process_post_request('update_user', $name, $user, $errors); 

    if($result) {     
        redirect_to('show.php?id=' . $state['id']);
    }
}

// read the values to display
$user = array_map("h", $user);
foreach ($name as $key) {
    $value[]=$user[$key];
}
?>

<?php $page_title = 'Staff: Edit User ' . $cur_name; ?>

<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">

  <a href="index.php">Back to Users List</a><br />

  <h1>Edit User: <?php echo  $cur_name;?></h1>

    <?php echo display_errors($errors);
    echo input_area($value_title, $name, $value, $redirect) ?>

<?php require SHARED_PATH . '/footer.php'; ?>
