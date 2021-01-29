<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/9/2020
 * Time: 9:14 PM
 */
?>

<?php
  session_start();
  session_unset();

  $_SESSION["userName"] = $_REQUEST['userName'];
  $_SESSION["userId"] = "1001";
?>
