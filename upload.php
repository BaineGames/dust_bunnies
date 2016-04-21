<?php
if($_POST){
$target_file = basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). 
        " has been uploaded.<br><a href='dust_bunnies.php'>Click here to go to Dust Bunnies and check console</a><br><br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}

?>

<form action=upload.php method="post" enctype="multipart/form-data">
    Select file to upload - must be input.txt<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <input type="submit" value="Upload File" name="submit">
</form>