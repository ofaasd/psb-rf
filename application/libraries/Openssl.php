<?php
/**
* 
*/
class Openssl
{
	function convert($action, $string) {
      $output = false;

      $encrypt_method = "AES-256-CBC";
      $secret_key = 'rer54etrg5eysdkjhf8ds7gfdubfd8sfydvf';
      $secret_iv = 'g5gtghh45dsnfiu73b38b83fb873fb8';

      // hash
      $key = hash('sha256', $secret_key);
      
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      
      if( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
      }
      else if( $action == 'decrypt' ){
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }

      return $output;
    }

    function anti($string) {
        $output = stripslashes(strip_tags(htmlspecialchars($string ,ENT_QUOTES)));
        return $output;
    }
}
?>