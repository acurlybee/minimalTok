<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ethiotok";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect.");
}

if(isset($_GET['v'])){
	$sorc = $_GET['v'];
	$theid = $_GET['i'];
  $sql = "SELECT * FROM videos WHERE id = '$theid'";
  $sqll = "UPDATE `videos` SET `views`= views + 1 WHERE id = '$theid'";
      mysqli_query($con, $sqll);
  $result = mysqli_query($con, $sql) or die('query failed');
while ($row = mysqli_fetch_assoc($result)){
  $text = $row['text'];
  $viw = $row['views'];
}
  $sql = "SELECT * FROM videos WHERE id != '$theid' ORDER BY RAND()
  LIMIT 1";
$result = mysqli_query($con, $sql) or die('query failed');
while ($row = mysqli_fetch_assoc($result)){
  $next = $row['src'];
  $nextid = $row['id'];
}
} else {

$sql = "SELECT * FROM videos
ORDER BY RAND()
LIMIT 1";
      $result = mysqli_query($con, $sql) or die('query failed');
        while ($row = mysqli_fetch_assoc($result)){
          $sorc = $row['src'];
          $beid = $row['id'];
          
        }
        $sqll = "UPDATE `videos` SET `views`= views + 1 WHERE id = '$beid'";
      mysqli_query($con, $sqll);
        

        $sql = "SELECT * FROM videos WHERE id != '$beid' ORDER BY RAND()
        LIMIT 1";
      $result = mysqli_query($con, $sql) or die('query failed');
      
      while ($row = mysqli_fetch_assoc($result)){
        $next = $row['src'];
        $nextid = $row['id'];
  $viw = $row['views'];
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
    body{
        /* display: flex; */
        align-items: center;
        justify-items: center;
        align-content: center;
        align-items: center;
    }
.nav div{
 /* position: fixed; */
 text-shadow: 0 0 10px yellow;
 font-size: 9vw;
 border-radius: 50%;
 align-content: center;
 padding: 5px;
 z-index: 55;
 justify-content: center;
 margin-top: 3vw;

}
.nav{
    height: 100%;
 right: 30px;
 justify-self:center;
align-self:center;
}

#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  z-index: -1;
  width: 100%; 
  min-height: 100%;
}
* {
  box-sizing: border-box;
}
.nav .pause{
    top: 0;
    width: 10vw;
    position: fixed;

}
.nav .mute{
    bottom: 0;
    position: fixed;

}
section{
    position: fixed;
    right: 0;
    top: 0;
}
p{
 text-shadow: 0 0 10px yellow;
  font-size: 5vw;
  position: fixed;
  bottom: 0;
  left: 50%;
  right: 50%;
}
</style>
<body>
  <p><?php echo $text?><span> view <?php echo $viw?></span></p>
    <div class="nav">
        <div class="pause">
            <i id="myBtn" onclick="myFunction()" class="fa-solid fa-pause"></i>
            <!-- <i class="fa-solid fa-play"></i> -->
        </div>
    <section>
        <div class="create">
           <a href="upload.php"> <i class="fa-solid fa-plus"></i> </a>
        </div>
        <div class="downarrow">
        <a href="index.php?v=<?php echo $next?>&i=<?php echo $nextid?>"> <i class="fa-solid fa-angle-down"></i> </a>
        </div>
    </section>
        <div class="mute">
            <i id="myBtn2" onclick="myFunction2()"class="fa-solid fa-volume-xmark"></i>
</div>
<script>
    var video = document.getElementById("myVideo");
    var btn2 = document.getElementById("myBtn2");
    
    function myFunction2() {
      if (video.muted == true) {
        video.muted = false;

        if (btn2.className == "fa-solid fa-volume-xmark") {
    btn2.className = "fa-solid fa-volume-high";
  } else {
    btn2.className = "fa-solid fa-volume-xmark";
  }

      } else {
        video.muted = true;
        if (btn2.className == "fa-solid fa-volume-xmark") {
    btn2.className = "fa-solid fa-volume-high";
  } else {
    btn2.className = "fa-solid fa-volume-xmark";
  }
      }
    }
    </script>
</div>
<video autoplay muted loop id="myVideo">
    <source src="<?php echo $sorc;?>" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
<script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    if (btn.className == "fa-solid fa-pause") {
    btn.className = "fa-solid fa-play";
  } else {
    btn.className = "fa-solid fa-pause";
  }
  } else {
    video.pause();
    if (btn.className == "fa-solid fa-pause") {
    btn.className = "fa-solid fa-play";
  } else {
    btn.className = "fa-solid fa-pause";
  }
  }
}
</script>

</body>
</html>