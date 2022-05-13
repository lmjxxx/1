<?php
$postid=$_POST['id'];
$postpw=$_POST['pw'];
$c= new PDO('mysql:host=localhost;dbname=secu','root','1234');
$st=$c->query("SELECT name FROM test WHERE id=:id");
$stmt->bindValue(":id",$postid);
$st=excute();

$result=$st->fetch();
if($postid==$result['id']&&$postpw==$result['pw']) header("Location:/gugu.php");
else header("Location:/login.html");*/
?>