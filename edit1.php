<?php
require 'db.php';

$id=$_GET['id'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];

$sql=$connection->prepare("update people set name='$name', email='$email' where id=$id");

$sql->execute();
?>

<h2 align="center">Update Records</h2>

<form method="post" align="center">
      
Name <input value="<?= $person->name; ?>" type="text" name="name" id="name"><br/><br/> 
Email <input type="email" value="<?= $person->email; ?>" name="email" id="email" ><br/><br/>
<button type="submit" name="submit">Submit</button>
<button type="submit" class="btn btn-info">Update</button>
</form>


<h2 align=center>All Records</h2>
  <table border=1px solid black width=70%  align=center>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        <?php
          //---------------------display-------------
        $sql = 'SELECT * FROM people';
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $people = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach($people as $person)
        { ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->name; ?></td>
            <td><?= $person->email; ?></td>
            <td><a href="edit.php?id=<?= $person->id ?>" >Edit</a></td>
            <td><a href="delete.php?id=<?= $person->id ?>">Delete</a></td>
          </tr>
        <?php
        } ?>
  </table>