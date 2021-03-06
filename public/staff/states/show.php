<?php require_once '../../../private/initialize.php'; ?>

<?php
$id = $_GET['id'];

if(!is_valid_id($id)) {
    redirect_to('index.php');
}

$state_result = find_state_by_id($id);
// No loop, only one result
$state = db_fetch_assoc($state_result);
?>

<?php $page_title = 'Staff: State of ' . h($state['name']); ?>
<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>State: <?php echo h($state['name']); ?></h1>

    <?php
    echo "<table id=\"state\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . h($state['name']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Code: </td>";
    echo "<td>" . h($state['code']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Country ID: </td>";
    echo "<td>" . $state['country_id'] . "</td>";
    echo "</tr>";
    echo "</table>";
?>
    <br />
    <a href="edit.php?id= <?php echo $state['id']; ?>">Edit</a><br />
    <hr />

    <h2>Territories</h2>
    <br />
    <a href="../territories/new.php?state= <?php echo $state['id']; ?>">Add a Territory</a><br />

<?php
    $territory_result = find_territories_for_state_id($state['id']);

    echo "<ul id=\"territories\">";
    echo "<table id=\"territories\" style=\"width: 500px;\">";
 while($territory = db_fetch_assoc($territory_result)) {
    echo "<tr><td>";
    echo "<a href=\"../territories/show.php?id=" . h($territory['id']) . "\">";
    echo h($territory['name']);
    echo "</a></td><td>";
    echo "<a href=\"../territories/edit.php?id=" . h($territory['id']) . "\">";
    echo "Edit";
    echo "</a>";
    echo "</td></tr>";
} // end while $territory
echo "</table";
    db_free_result($territory_result);
    echo "</ul>"; // #territories

    db_free_result($state_result);
    ?>

</div>

<?php require SHARED_PATH . '/footer.php'; ?>
