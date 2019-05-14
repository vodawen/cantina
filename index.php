<?php 
include "ctrl.php";

$ctrl = new Controler($_SERVER['REQUEST_URI']);
$ctrl->aiguiller();


?>