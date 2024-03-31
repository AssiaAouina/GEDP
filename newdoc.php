

<?php

include('database.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_SESSION[ 'user'];
  $redirect = $_SERVER ['HTTP_REFERER'];
  $documentName = $_POST['name'];
    $folderID = $_POST['folder'];
    $documentDesc = $_POST['desc'];
    $sql1 = "SELECT * from folders where folder_id = $folderID";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            $foldername = $row1['folder_name'];
            $uploadDir = 'folderslist/' . $foldername . '/';
            $uploadFile = $uploadDir . basename($_FILES['file']['name']);

            if (file_exists($uploadFile)) {
                $_SESSION['file_exists'] = "success";
                            header("location: $redirect");
            } else {
                if ($_FILES['file']['size'] <= $maxFileSize) {
                    $fileSize = $_FILES['file']['size']; 
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                        // File uploaded successfully, insert data into the database
                        $sql = "INSERT INTO documents (doc_user, doc_name, doc_folder, doc_desc, doc_path, doc_size) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("isissi", $id, $documentName, $folderID, $documentDesc, $uploadFile, $fileSize);

                        if ($stmt->execute()) {
                            // Insertion successful                   
                            $_SESSION['doc_upload'] = "success";
                            header("location: $redirect");
                            exit();
                        } else {
                            // Insertion failed
                            echo "Error: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        // File upload failed
                        echo "File upload failed!";
                    }
                } else {
                    $_SESSION['file_size'] = "success";
                    header("location: $redirect");
                }
            }
        }
    } else {
        echo "Error in fetching folder name from database";
    }
}
?>
   