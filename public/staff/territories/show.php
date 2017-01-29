<?php require_once '../../../private/initialize.php'; ?>

<?php
$id=$_GET['id'];
if(!is_valid_id($id)) {
    redirect_to('index.php');
}

$territory_result = find_territory_by_id($id);
// No loop, only one result
$territory = db_fetch_assoc($territory_result);

$territory=array_map("h",$territory);

// extract state name
$state_id = $territory['state_id'];
$state_result= find_state_by_id($state_id);
$state = db_fetch_assoc($state_result);
$state_name = h($state['name']);

?>

<?php $page_title = 'Staff: Territory of ' . $territory['name']; ?>
<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">
  <a href="index.php?state=<?php echo $state_id?>">Back to State Details</a>
  <br />

  <h1>Territory: <?php echo $territory['name']; ?></h1>

    <?php
    echo "<table id=\"territory\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . $territory['name'] . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>State Name: </td>";
    echo "<td>" . $state_name . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Position: </td>";
    echo "<td>" . $territory['position'] . "</td>";
    echo "</tr>";
    echo "</table>";

    db_free_result($territory_result);
    ?>
  <br />
  <a href="edit.php?id=<?php echo $territory['id'];?>">Edit</a><br />

</div>

<?php require SHARED_PATH . '/footer.php'; ?>
