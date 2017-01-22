<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    $reg = '/\A[A-Za-z0-9\@\.\-\_]+\Z/';
    if(preg_match($reg,$value)){
        return true;
      }

    return false;
  }

//My custom validation
   // has_valid_phone_format('123-456-7890' or (123)-455-7890 or (123)4567890)
  function has_valid_phone_format($value) {


    $reg[] = '/^(\d{3}|\(\d{3}\))-\d{3}-\d{4}$/'; //123-456-7890 or (123)-456-7890
    $reg[] = '/^(\d{3}|\(\d{3}\))\d{7}$/'; ////1234567890 or (123)4567890
    $reg[] = '/^(\d{3}|\(\d{3}\)) \d{3} \d{4}$/'; //123 456 7890 or (123) 456 7890

  foreach ($reg as $r) {
    if(preg_match($r,$value)){
          return true;
      }
    }    
   
   return false;
  }
 
 //My custom validation
 // check for positive integer
 function is_valid_id($value){
  if(is_numeric($value)){ // check if it is number
    if(is_int($value+0)){ // check if it is int
      if($value+0>0){
      return true;
    }
    }
  }
  return false;
 }

//My custom validation
 // check username
function is_valid_user_name($value){
   if(has_length($value, array('max' => 255))){
      $reg = '/\A[A-Za-z0-9\_]+\Z/';
      if(preg_match($reg,$value)){

        return true;
      }
   }
  return false;
 }

//My custom validation
 // check state abbrev
function is_valid_abbreviation($value){
   
   if(has_length($value, array('min' => 2,'max'=> 2))) {
      $reg = '/\A[A-Za-z]+\Z/';
      if(preg_match($reg,$value)){
        return true;
      }
   }
  return false;
 }

//My custom validation
 // check for username uniqueness
function is_unique_abbreviation_code($code=''){
  global $db;

  $sql = "SELECT COUNT(*) as num FROM states where code = '" . strtoupper(db_escape($db,$code)) ."'";
  $result =db_query($db,$sql);
  $data = db_fetch_assoc($result);

  if($data['num']+0 == 0){return true;}
  return false;

}

?>
