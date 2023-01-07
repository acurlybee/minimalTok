<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ethiotok";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect.");
}

if(isset($_POST['submit'])){
    $text = $_POST['text'];

   echo $text;
  }
    /*file upload*/
    if (isset($_FILES['files'])) {
  
      $unique_id = rand(1,99999);
  echo $unique_id;
      $file_name = $_FILES['files']['name'];
      $link = "videos/".$unique_id.$file_name;
      $file_tmp = $_FILES['files']['tmp_name'];
  
        if (move_uploaded_file($file_tmp, $link)) {
          if ($text != "") {
   $sql = "INSERT INTO `videos`(`src`, `views`, `text`) 
   VALUES ('$link','0','$text')";
            $result = mysqli_query($con, $sql) or die('query failed');
     
  
            
            
          }else{
            echo 'fill all data';
          }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <script src="https://kit.fontawesome.com/e0332b7389.js" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EthioTok</title>
</head>
<style>
    BODY{
        align-content: center;
        justify-content: center;
        display: flex;
        
    }
    BODY {
background: linear-gradient(46deg, #00ffbd, #c8c900, #ad3b00);
background-size: 600% 600%;

-webkit-animation: BG 10s ease infinite;
animation: BG 10 ease infinite;
}

@-webkit-keyframes BG {
0%{background-position:10% 0%}
50%{background-position:91% 100%}
100%{background-position:10% 0%}
}
@keyframes BG {
0%{background-position:10% 0%}
50%{background-position:91% 100%}
100%{background-position:10% 0%}
}
</style>
<body>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <input type="text" name="text" placeholder="type somthing">
    <input id="file" type="file" name="files"><BR><BR>
    <input name="submit"type="submit" value="UPLOAD">
</form><BR><BR>
<a href="index.php">back</a>

</body>
</html>