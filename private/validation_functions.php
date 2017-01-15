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
    return strpos($value, '@') !== false;
  }

   // has_valid_phone_format('123-456-7890' or (123)-455-7890 or (123)4567890)
  function has_valid_phone_format($value) {


    $reg[] = '/^(\d{3}|\(\d{3}\))-\d{3}-\d{4}$/'; //(123-456-7890) or (123)-456-7890
    $reg[] = '/^(\d{3}|\(\d{3}\))\d{7}$/'; ////(1234567890) or (123)4567890
    $reg[] = '/^(\d{3}|\(\d{3}\)) \d{3} \d{4}$/'; //(123 456 7890) or (123) 456 7890

  foreach ($reg as $r) {
    if(preg_match($r,$value)){
          return true;
      }
    }    
   
   return false;
  }

?>
