<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roshni";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// $id=$_GET['id'];
$sql=$conn->prepare("select * from people");
$sql->execute();
?>
<table>
<table border="1px">
<tr>
    <td>Id</td>
    <td>Name</td>
   <td>Email</td>
   
</tr>
<?php
while($row=$sql->fetch())
{
    ?>
    <tr>
    <td><?php echo $row['id']?></td>
    <td><?php echo $row['name']?></td>
    <td><?php echo $row['email']?></td>
    
</tr>
    <?php
}
?>
</table>
<?php
// $fname=$_GET['firstname'];
// $lname=$_GET['lastname'];
// $email=$_GET['email'];
// $output=$conn->prepare( "INSERT INTO none (firstname, lastname,email) values('$fname','$lname','$email')");
// $output->execute();
?>