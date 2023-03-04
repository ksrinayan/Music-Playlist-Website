<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: lightgreen;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
.B{
  float:right;
}

</style>
</head>
<body>

<ul>
  <li><a class="active" href="musicpagedisplay.php">Home</a></li>
  <li><a href="fav.php">MyFav</a></li>
<li><a href="upload.php">UploadSong</a><li>
  <li class="B" ><a href="logout.php">Logout</a></li>
</ul>


<?php
session_start();
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"login");
$c=$_SESSION['uid'];
$query="select songid from myfav where uid='$c'";
$result=mysqli_query($con,$query);

echo "<div class='row'>";




while($row=mysqli_fetch_array($result) )
{
  if($row['songid']<=11)
  {$url="m".$row['songid'].".jpg";

  $url1="m".$row['songid'].".mp3";


?>
<div class="col-lg-3">
  <img src="<?php echo $url;?>" height="200" width="200">
  <br>


  <audio controls>

    <source src="<?php echo $url1;?>" type="audio/mp3">
    </div>
<?php

}
else{
  $p=$row['songid'];
    $query2="select file_name from images where id='$p'";
    $result1=mysqli_query($con,$query2);
    $row3=mysqli_fetch_array($result1);

    $url2=$row3['file_name'].".mp3";


  ?>
  <div class="col-lg-3">



    <audio controls>

      <source src="<?php echo $url2;?>" type="audio/mp3">
      </div>
<?php
}
}
?>





</body>
</html>
