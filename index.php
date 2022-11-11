<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="file[]" value="" multiple>
        <br><br><br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>

</html>
<?php
$uploaded = false;
if (isset($_POST["submit"])) {
    $filesCount = count($_FILES["file"]["name"]);
    for ($i = 0; $i < $filesCount; $i++) {
        $file_name = $_FILES["file"]["name"][$i];
        $file_tem = $_FILES["file"]["tmp_name"][$i];
        $file_size = $_FILES["file"]['size'][$i];
        $file_type = $_FILES["file"]['type'][$i];

        $allowed_extensions = array('pdf', 'docx', 'png', 'gpeg');
        $splitted_name = explode('.', $file_name);
        $file_ex = end($splitted_name);

        if (in_array($file_ex, $allowed_extensions)) {
            $file_ex = strtolower($file_ex);
            $newFileName = rand(100000, 900000) . '.' . $file_ex;
            $target = "folderToUpload/" . $newFileName;
            $upload = move_uploaded_file($file_tem, $target);
            $uploaded = true;
        } else {
            die("Blocked File Extention");
        }
    }
    if ($uploaded) {
        die("Upload successfully");
    } else {
        die("Upload unsuccessfully");
    }
} else {
    die("There is no file to upload.");
}
