<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <style>
        *{
            margin: 0;
            padding: 0; 
        }
        
       .maincontainer{
           width: 100%;
           height: auto;
           margin: auto;
       }
       .innercontainer{
           padding-top: 100px;
           width: 96%;
           height: 250px;
           background-color: white;
           margin: auto;
           margin-top: 100px;
           text-align:center;
       }
       .innercontainer h1{
        font-size: 70px;
        font-family: sans-serif;
        text-shadow: 3px 3px grey;
        color: red ;
        margin-bottom: 25px;
       }
       input{
        width: 500px;
        height: 60px;
        border-radius: 40px;
        font-size: 25px;
        padding-left: 40px;
        padding-right: 40px;
        font-family: sans-serif;
        border: 1px solid grey;
       }
       form{
        margin-bottom: 20px;
       }
       button{
        font-size: 25px;
        padding:15px 30px 15px 30px;
        border-radius: 30px;
        margin-left: 10px;
        background-color: red;
        border:none;
        color: white;
        font-family: sans-serif;
       }
       button:hover{
        background-color: darkred;
       }
       .article{
       width: 96%;
      margin: auto  ;
       background-color: white;
       margin-bottom: 100px;
       font-size: 20px;
       }
       .content{
        border:1px solid gray;
        padding: 5px 5px 5px 15px;
        margin-top: 20px;
        border-radius: 20px;
       }
       .content h3{
        margin-bottom: 8px;
        font-size: 25px;
        color: red;
       }
     
   </style>
</head>
<body>
<div class="maincontainer">
    <div class="innercontainer">
        <h1>Search Engine</h1>
            <form >
               <input type="text" name="input"  placeholder="Search..." />
               <button type="Submit" name="search" value="search">Search</button>
            </form>
    </div>
</div>
<div class="article">
<?php
$connect=mysqli_connect("localhost:3308","root","","search");
  
    if(!empty($_REQUEST['search']))
    {
        $search=$_REQUEST['input'];

        $k=strpos($search,"-");
        echo $k;
        if($k)
        {
            $key=explode ('-',$search);
            $s1=$key['0'];
            $s2=$key['1'];
        
            $search_string = "SELECT * FROM article WHERE ";
            
            $search_string.= "title not LIKE '%".$s2."%' OR content not LIKE '%".$s2."%'  and  title LIKE '%".$s1."%' OR content LIKE '%".$s1."%' ";
            
            //$display_words .= $s1.' ';
          echo $search_string;
            $query = mysqli_query($connect, $search_string);
            $result_count = mysqli_num_rows($query);

            echo '<div class="right"><b><u>'.number_format($result_count).'</u></b> results found</div>';
            echo 'Your search for <i>"'.$display_words.'"</i><hr />';


            $result_count=mysqli_num_rows($query);
  
            echo "
                 <div class='found'>$result_count Results found";
    
                  if($result_count != 0)
                  {
                     while($row = mysqli_fetch_assoc($query))
                    {
                        echo"<a href='article.php?title=".$row['id']."'>
                        <div class='content'>
                        <h3>".$row['title']."</h3></a>
                        <p>".$row['content']."</p>
                        </div>"; 
                    }
                }
        }
        else{
        $search_string = "SELECT * FROM article WHERE ";
        $display_words = "";
			
        $key = explode(' ', $search);			
        foreach ($key as $word)
        {
        	$search_string .= "title LIKE '%".$word."%' OR content LIKE '%".$word."%' OR  ";
	        $display_words .= $word.' ';
        }
        $search_string = substr($search_string, 0, strlen($search_string)-4);
        $display_words = substr($display_words, 0, strlen($display_words)-1);
        echo $search_string;
        $query = mysqli_query($connect, $search_string);
        $result_count = mysqli_num_rows($query);

        echo '<div class="right"><b><u>'.number_format($result_count).'</u></b> results found</div>';
        echo 'Your search for <i>"'.$display_words.'"</i><hr />';


        $result_count=mysqli_num_rows($query);
  
        echo "
        <div class='found'>$result_count Results found";
    
        if($result_count != 0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                echo"<a href='article.php?title=".$row['id']."'>
                <div class='content'>
                    <h3>".$row['title']."</h3></a>
                    <p>".$row['content']."</p>
                </div>"; 
            }
        }
    }
    }
 ?>
</div>
</body>
</html>