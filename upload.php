<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body{


  background-repeat: no-repeat;
  background-size: 1440px 1080px;
  background-position: center;
}
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
audio{
  width:200px;
}



</style>
</head>
<body>

<ul>
  <li><a  href="musicpagedisplay.php">Home</a></li>
  <li><a href="fav.php">MyFav</a></li>

    <li><a href="upload.php">UploadSong</a><li>
<li class="B" ><a href="logout.php">Logout</a></li>
</ul>
<br>
<?php
// Database configuration
session_start();
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"login");
$c=$_SESSION['uid'];

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
error_reporting(0);
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Music File to Upload:
    <input type="file" name="file"><br>
    <input type="submit" name="submit" value="Upload">
</form>
<?php
// Include the database configuration file

$statusMsg = '';
$s=11;
// File upload path
$targetDir = "C:\xampp\htdocs\DBMS PROJECT\/";
$fileName = basename($_FILES["file"]["name"]);
//$tmp_name = $_FILES['file']['tmp_name'];
echo "gg";
echo realpath($_FILES["file"]["tmp_name"]);


$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$x = pathinfo($fileName, PATHINFO_FILENAME);



if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats

    $allowTypes = array('mp3');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server

        if($_SERVER['DOCUMENT_ROOT'].'/$fileName'){
            // Insert image file name into database

            $query1="select id from images";
            $result3=mysqli_query($con,$query1);
  $count=11;
while($row2=mysqli_fetch_array($result3)){
$count++;

}

            if($count==11){$s=12;}
            else{$s=$count+1;}



  $query1="select id from images where userid='$c'";
  $result3=mysqli_query($con,$query1);
  $row4=mysqli_fetch_array($result3);



            $query="insert into images (id,userid,file_name) values ('$s','$c','$x');";

            $insert=mysqli_query($con,$query);




            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";

            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, MP3 files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
$url=$x.".mp3";

?>


</body>
</html>
