<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  // this compares post value with entry value, does db request and returns error and 
  function process_post_request($function='',&$name='',&$db_result='',&$errors=''){
  // Confirm that values are present before accessing them.
    foreach ($name as $key) {
      if(isset($_POST[$key])) {$db_result[$key] = $_POST[$key]; }
    }
   
      // db query
     $result = call_user_func($function,$db_result);
     if($result === true) {
       return true;
     } 
      else {
        $errors = $result;
        return false;
        
      }
  }

  function display_errors($errors=array()) {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

// displays input based on array input

function input_area($title=[],$name=[], $value=[], $redirect=''){
  $out= '<div id ="input-area"><form action="' .$redirect .'" method="post">';

  for($i = 0; $i<sizeof($title);$i++){
    $out.= '<div>';
    $out.= $title[$i];
    $n = h($name[$i]);
    $v = h($value[$i]);
    $out.= '<input type="text" name="' . $n . '" value="' . $v .'"';
    $out.= '<hr //> <//div>';
  }
  
  $out.= '<div><input type="submit" class="btn btn-info" value="Submit" //><//form> <//div><//div>';

  return $out;
}

?>
