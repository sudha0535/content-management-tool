<?php


$db=new mysqli("localhost" , "root" , " " , "cms");
$email="admin@gmail.com";
$password="secret";

$sql="select email  from users where email=? and password=?";
$stmt=$db->prepare($sql);
$stmt->bind_param( 'ss',$email, $hashed);
$stmt->execute();
$stmt->bind_result($email);
while($stmt->fetch());
{
    echo $email;
}



?>