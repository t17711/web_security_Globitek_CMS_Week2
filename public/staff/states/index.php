<?php require_once '../../../private/initialize.php'; ?>

<?php $page_title = 'Staff: States'; ?>
<?php require SHARED_PATH . '/header.php'; ?>

<div id="main-content">
  <a href="../index.php">Back to Menu</a><br />


    <?php 
      $countries = find_all_countries();

    foreach ($countries as $country) {
        $state_result = find_states_for_country_id($country['id']);
            
        echo "<h1>States in" . h($country['name']). "</h1>";
        echo "<a href=\"new.php?country=". $country['id']."\">Add a State in ". $country['name']. "</a><br /><br />";


        echo "<table id=\"states\" style=\"width: 500px;\">";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Code</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        while($state = db_fetch_assoc($state_result)) {
            echo "<tr>";
            echo "<td>" . h($state['name']) . "</td>";
            echo "<td>" . h($state['code']) . "</td>";
            echo "<td>";
            echo "<a href=\"show.php?id=".$state['id']."\">Show</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=\"edit.php?id=".$state['id'] ."\">Edit</a>";
            echo "</td>";
            echo "</tr>";
        } // end while $states

        db_free_result($state_result);
        echo "</table>"; // #states
    }
   
    ?>

</div>

<?php require SHARED_PATH . '/footer.php'; ?>
