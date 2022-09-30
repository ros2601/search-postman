<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roshni";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// $id=$_GET['id'];
$sql=$conn->prepare("select * from people");
$sql->execute();
$num=$sql->rowCount();
if($num>0)
{
    $post_arr=array();
    $post_arr['data']=array();

while($row=$sql->fetch())
{
    extract($row);
    $post_item=array(
       'id'=>$id,
       'name'=>$name,
       'email'=>$email);
       array_push($post_arr['data'],$post_item);
    } 
      
      echo json_encode($post_arr);
    ?>
    <?php
}

?>