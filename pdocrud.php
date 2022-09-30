<?php
  require 'db.php';

//--------------------insert-------------------
if (!empty($_REQUEST['name'])  && !empty($_REQUEST['email']) ) 
{
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];

  $sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
  $statement = $connection->prepare($sql);

  if ($statement->execute([':name' => $name, ':email' => $email])) 
  {
    $message = 'Record inserted successfully';
  }

}

 ?>

<h2 align=center  >Insert Records</h2>

<?php 
  if(!empty($message))
  {
    echo $message; 
  }
?>
       
<form align=center>
Name <input type="text"  name="name" id="name"><br/><br/>
Email <input type="email" name="email" id="email"><br/><br/>
      <button type="submit" name="submit">Submit</button><br/?<br/>
      
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
   