<?php

require_once '../../../private/initialize.php';
$id=$_GET['id'];
if(!is_valid_id($id)) {
    redirect_to('index.php');
}

$users_result = find_user_by_id($id]);
// No loop, only one result
$user = db_fetch_assoc($users_result);



$name[] = 'first_name';
$name[] = 'last_name';
$name[] = 'username';
$name[] = 'email';

$value_title[]='Enter First Name: ';
$value_title[]='Enter Last Name: ';
$value_title[]='Enter Username: ';
$value_title[]='Enter Email: ';

$value =[];


$redirect =$_SERVER["PHP_SELF"].'?id='.$user['id'];

// Set default values for all variables the page needs.
$errors = array();
if(is_post_request()) {
    // Confirm that values are present before accessing them.
    foreach ($name as $key) {
        if(isset($_POST[$key])) { $salesperson[$key] = $_POST[$key];
        }
    }

    $result = update_user($user);

    if($result === true) {
        redirect_to('show.php?id=' . $user['id']);
    } else {
        $errors = $result;
    }
}

// read the values to display
$user = array_map("h", $user);
foreach ($name as $key) {
    $value[]=$user[$key];
}
?>
<?php $page_title = 'Staff: Edit User ' . $user['first_name']. " " . $user['last_name'] ; ?>
<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">

  <a href="index.php">Back to Users List</a><br />

  <h1>Edit User: <?php echo  $user['first_name'] . " " . $user['last_name'] ;?></h1>

    <?php echo display_errors($errors);
    echo input_area($value_title, $name, $value, $redirect) ?>
<?php require SHARED_PATH . '/footer.php'; ?>
