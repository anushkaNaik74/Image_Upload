<?php include($_SERVER['DOCUMENT_ROOT'] . '/Image_Upload/Database/database.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .gallery_content{
            width: 90%;
            margin: 0px auto;
            margin-top: 10rem;
            margin-bottom: 10px;
            background-color:#F8FBFE;
            padding: 10rem 1rem 10rem auto;
            align-items: center;
        }

        .gallery_images_heading{
            font-family: 'Poppins', sans-serif; 
            font-size: 2.5rem; 
            font-weight: 300; 
            color: #202842; 
            text-align: center; 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            line-height: 1.3; 
            padding-bottom: 4rem;
        }

        @media screen and (max-width: 600px) {
            .gallery_content{
                padding: 1rem 1rem 1rem 1rem;
            }

            .image_content {
                max-width: 100%; /* Limit the maximum width of the image */
                height: auto; /* Allow the height to adjust automatically */
            }


            .gallery_images_heading{
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="gallery_content">
        <?php
            // select query
            $fetch_gallery_images_query = "SELECT * from upload_png";
            $fetch_gallery_images_query_sql = mysqli_query($con,$fetch_gallery_images_query);
            $count_query = mysqli_num_rows($fetch_gallery_images_query_sql);
            if($count_query != '0'){
                echo "<h1 class='gallery_images_heading'>Images Uploaded</h1>";
            while($row = mysqli_fetch_assoc($fetch_gallery_images_query_sql)){
                $fileName = $row['file_name'];
                $filePath = '../Database/png_images/' . $fileName;
                ?>
                <embed
                    class = "image_content"
                    src="<?php echo $filePath; ?>"
                    width="350px"
                    height="260px"
                />
                <?php
            }
            }else{
                ?> 
                    <p>No such file found</p>
                <?php
            }
        ?>
    </div>
</body>
</html>