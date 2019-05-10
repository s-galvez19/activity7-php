<?php
$target_dir = "upload";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);

$uploadOK = 1;

$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

//Check if image file is an actual image or fake image
if (isset($_POST["submit"])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false){
        echo 'File is an image - '. $check["mime"].".";
        $uploadOK = 1;
    }else{
        echo 'file is not an image .';
        $uploadOK = 0;
    }

    
}

//Check if file aready exists
if(file_exists($target_file)){
    echo "Sorry, file already exists.";
    $uploadOK = 0;
}

//Check file size
if($_FILES["fileToUpload"]["size"] > 500000){
    echo "Sorry, your file is too large.";
    $uploadOK = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg"){
    echo 'Sorry, only JPG, JPEG, PNG & GIF file are allowed.';
    $uploadOK = 0;
}

// Check if $uploadOK is set to 0 by an error
if ($uploadOK == 0 ){
    echo 'Sorry, your file was not uploaded.';
}else{
   if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
       echo 'The file ' . basename($_FILES['fileToUpload']['name'])."has been uploaded, ";
    } else{
         echo 'Sorry, there was an error uploading your file.';
       }

   }

?>