<?php
$path = "uploads/" . $_POST["id"] ."/";
echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            
            echo "Error uploading: " . $_FILES["files"]["error"][$i] . "<br>";
        } else {
            if (file_exists('uploads/' . $_FILES["files"]["name"][$i])) {
                echo 'File already exists :' . $_FILES["files"]["name"][$i] . "<br>";

            } else {
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $path . $_FILES["files"]["name"][$i]);
                echo 'File successfully uploaded :'. $_FILES["files"]["name"][$i] . '<br>';
            }
        }
    }
} else {
    echo 'Please choose at least one file';
}
?>