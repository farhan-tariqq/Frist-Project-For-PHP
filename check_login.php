<?php
  	if(isset($_SESSION['role']) and $_SESSION['role'] != "manager")
  {
       session_destroy();
       header("location: ../login.php");
       exit();
        }
        else if(isset($_SESSION['role']) && $_SESSION['role'] == "manager")
        {
       header("location: index.php");
       exit();
        }
?>