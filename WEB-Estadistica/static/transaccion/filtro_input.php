<?php
function cleanInput($input) {
 
    $search = array(
      '@<script[^>]*?>.*?</script>@si',   
      '@<[\/\!]*?[^<>]*?>@si',            
      '@<style[^>]*?>.*?</style>@siU',    
      '@<![\s\S]*?--[ \t\n\r]*>@'         
    );
   
      $output = preg_replace($search, '', $input);
      $output = str_ireplace("SELECT","",$output);
      $output = str_ireplace("COPY","",$output);
      $output = str_ireplace("DELETE","",$output);
      $output = str_ireplace("DROP","",$output);
      $output = str_ireplace("DUMP","",$output);
      $output = str_ireplace(" OR ","",$output);
      $output = str_ireplace("%","",$output);
      $output = str_ireplace("LIKE","",$output);
      $output = str_ireplace("--","",$output);
      $output = str_ireplace("^","",$output);
      $output = str_ireplace("[","",$output);
      $output = str_ireplace("]","",$output);
      $output = str_ireplace("*","",$output);	
      return $output;
    }
   
  function sanitize($input) {
      if (is_array($input)) {
          foreach($input as $var=>$val) {
              $output[$var] = sanitize($val);
          }
      }
      else {
          if (get_magic_quotes_gpc()) {
              $input = stripslashes($input);
          }
          $input  = cleanInput($input);
          $output = mysql_real_escape_string($input);
      }
      return $output;
  }
?>