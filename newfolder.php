<?php
if (!isset($_SESSION['user'])) {
   
    
}?>
<?php
include 'database.php';
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{$folderName = $_POST["folder"];
    $user = $_SESSION['user'];
    $redirect = $_SERVER['HTTP_REFERER'];
    $directory = "folderlist/"; 
    if (!file_exists($directory . $folderName)) {
        if (mkdir($directory . $folderName, 0777, true)){

            $sql = "INSERT INTO folders (folder_user, folder_name) VALUES ('$user', '$folderName')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['new_folder_created'] = "success";
                    header("location: $redirect");
            } else {
                echo "Error creating folder or inserting into the database: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Error creating folder.";
        }
    } else {
        $_SESSION['folder_exists'] = "success";
                    header("location: $redirect");
    }
}
?>

