<?php
if(isset($_POST['ok'])){
    $pwd=$_POST['pwd'];
    $new=$_POST['new'];
    $confirm=$_POST['confirm'];
    echo $pwd."<br/>".$new."<br/>".$confirm;
    
}


?>