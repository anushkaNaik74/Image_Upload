<?php include($_SERVER['DOCUMENT_ROOT'] . '/Image_Upload/Database/database.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PNG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <link rel="stylesheet" type="text/css" href="../Styles/add_png_image.css"  crossorigin="anonymous" referrerpolicy="no-referrer">
    
    
</head>
<body>

    <div class="gallery_items">
        <h3 class = "gallery_heading">Upload PNG Images</h3>
        <form action="./Backend/upload_png_image.php" class="dropzone" id="file_upload">
        </form>
        <div class="gallery_btn_outer">
            <a id='upload_btn' href="#" class = "gallery_btn">Upload</a>
            <a href="#" class = "gallery_btn"> Cancel</a>  
         </div>
    </div>

    <?php include('../Backend/png_images.php'); ?>
    <?php include('../Backend/png_image_details.php'); ?>
    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer" ></script>

    <script>
        Dropzone.autoDiscover = false;

        if (Dropzone.instances.length > 0) {
            Dropzone.instances.forEach(function(instance) {
                instance.destroy();
            });
        }
        var myDropzone = new Dropzone("#file_upload", {
            url:"../Backend/upload_png_image.php",
            acceptedFiles: '.png',
            maxFiles: 50,
            addRemoveLinks: true,
            maxFilesize: 5,
            autoProcessQueue:false,
            dictDefaultMessage: "click to upload png images"
        });

        $('#upload_btn').click(function(){
            myDropzone.options.autoProcessQueue = true;
            myDropzone.processQueue();
        });

        myDropzone.on("queuecomplete", function(file) {
            $.ajax({
                url: '../Backend/png_images.php', 
                success: function(data) {
                    $(".gallery_content").html(data); 
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching gallery images:", error);
                }
            });

            $.ajax({
                url: '../Backend/png_image_details.php', 
                success: function(data) {
                    $("table").html(data); 
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching gallery images:", error);
                }
            });
        });

    </script>
</body>
</html>