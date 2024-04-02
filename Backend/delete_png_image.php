<?php
include($_SERVER['DOCUMENT_ROOT'] . '/Image_Upload/Database/database.php');


if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    
    $sql = "SELECT file_name FROM upload_png WHERE id = $id";
    $result = mysqli_query($con, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fileName = $row['file_name'];
        
        
        $deleteQuery = "DELETE FROM upload_png WHERE id = $id";
        $deleteResult = mysqli_query($con, $deleteQuery);
        
        if($deleteResult) {
            
            $filePath = "../Database/png_images/" . $fileName;
            if(file_exists($filePath)) {
                unlink($filePath);
            } else {
                echo "File not found in folder!";
            }
            
            echo "success"; 
        } else {
            echo "Error deleting record from database: " . mysqli_error($con);
        }
    } else {
        echo "Record not found in database!";
    }
} else {
    echo "Invalid request!";
}
?>
