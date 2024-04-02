<?php include($_SERVER['DOCUMENT_ROOT'] . '/Image_Upload/Database/database.php');
 ?>
<?php 
if(!empty($_FILES)){ 

        $uploadDir = "../Database/png_images/"; 
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
            }
    
        $fileName = basename($_FILES['file']['name']); 
        $fileName = date('dmYhis') . $fileName;
        $uploaded_on = date('dmYhis');
        $uploadFilePath = $uploadDir.$fileName; 
     
        // Upload file to server 
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
            $insert_query = "INSERT INTO upload_png
                                (file_name,
                                uploaded_on)
                                VALUES (
                                    '$fileName',
                                    '$uploaded_on'
                                )";

            $insert_query_sql = mysqli_query($con, $insert_query);
            
            if ($insert_query_sql) {
                echo $fileName; 
            } else {
                echo "Error inserting data into database: " . mysqli_error($con);
            }            
        } else {
            echo 'Error uploading file.';
        }
    }
            


?>
