<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <style>
    body{
        background-color: lightGREY;        
    }
    .maincontainer
    {
        width: 100%;
        margin-top: 50px;
    }
    .article{
        width: 90%; 
        background-color: white;
        margin: auto;
        padding: 12px 30px 12px 30px;
        border-radius: 30px;
        border: 1PX solid black;
        margin-top: 5%;
    }
    h3{
        font-size: 40px;
        font-family: cursive;
        font-weight: 700;
        color:red;
        text-shadow: 2px 2px grey;
    }
    p{
        font-size: 20px;
        font-family: Arial, Helvetica, sans-serif;
    }
    </style>
</head>
<body>
    <div class="maincontainer">
    <?php
         $connect=mysqli_connect("localhost:3308","root","","search");
    ?>
   
    <div class="article">
    <?php
 
    $id=mysqli_real_escape_string($connect,$_REQUEST['title']);

    $query="select * from article where id='$id'";
    $result=mysqli_query($connect,$query);
    $queryresult=mysqli_num_rows($result);

    if($queryresult != 0)       
    {
        while($row=mysqli_fetch_assoc($result))
        {
            echo"
            <div>
            <h3>".$row['title']."</h3>
            <p>".$row['content']."</p>
            <p>".$row['date']."</p>
            <p>".$row['author']."</p>

            </div>";
        }
    }
    ?>
    </div>
    </div>
</body>
</html>