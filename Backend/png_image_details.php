<?php include($_SERVER['DOCUMENT_ROOT'] . '/Image_Upload/Database/database.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../Styles/png_image_details.css"  crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

    <table>
        <tr>
            <th>#</th>
            <th>Image ID</th>
            <th>File Name</th>
            <th>Uploaded On</th> 
            <th>Operations</th> 
        </tr>

        <?php
        $i = 1;
        $select_all_png_query = "SELECT * FROM upload_png";
        $select_all_png_query_sql = mysqli_query($con, $select_all_png_query);
        $count_select_all_png_query = mysqli_num_rows($select_all_png_query_sql);

        if($count_select_all_png_query  > 0){
            while ($row = $select_all_png_query_sql -> fetch_assoc()) {
            $id = $row['id'];
        ?>

        <tr id="row_<?php echo $id; ?>">
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['id']?></td>
        <td><?php echo $row['file_name']?></td>
        <td><?php echo $row['uploaded_on']?></td>

        <td class="operations">
        <a href="#" onclick="deleteImage(<?php echo $id; ?>); return false;" class="delete-button">Delete</a>
        </td>
        </tr>

        <?php 
            }
        }
        ?>
    </table>

    <script>
        function deleteImage(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: 'delete_png_image.php?id=' + id,
                    type: 'GET',
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $("#row_" + id).remove(); 
                            
                            updateGalleryContent();
                        } else {
                            alert('Error deleting image: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting image:", error);
                    }
                });
            }
        }

        function updateGalleryContent() {
            $.ajax({
                url: '../Backend/png_images.php',
                type: 'GET',
                success: function(data) {
                    $(".gallery_content").html(data); 
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching gallery images:", error);
                }
            });
        }

    </script>


</body>
</html>