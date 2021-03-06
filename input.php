<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
    <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    <!-- the font awesome icon library if using with `fas` theme (or Bootstrap 4.x). Note that default icons used in the plugin are glyphicons that are bundled only with Bootstrap 3.x. -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x (for popover and tooltips). You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- the main fileinput plugin file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
    <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/themes/fas/theme.min.js">
    </script>
</head>

<body>
    <label for="input-24">Planets and Satellites</label>
    <form id="test-form" method="POST" enctype="multipart/form-data">
        <div id="input-section">
            <input id="input-id" name="input24[]" type="file" multiple>

        </div>
        <br />
        <br />
        <br />
        <button type="submit" name="submit">hantar</button>
    </form>

    <script>
        $(document).ready(function() {


            $("#input-id").fileinput({
                uploadUrl: '#',
                maxFileSize: 1000,
                fileActionSettings: {
                    showRemove: true,
                    showUpload: false,
                    showZoom: false,
                    showDrag: false,
                }
            });

            $('#input-id').on('fileloaded', function(event, file, previewId, index, reader) {

                const r = new FileReader();
                r.readAsDataURL(file);
                r.onload = function() {
                    console.log(r.result);
                    $('<input/>').attr({
                        type: 'text',
                        id: previewId.replace(/[.|&;$%@"<>()+,]/g, ""), // + previewId,
                        name: 'upload[]',
                        class: 'uploadcls',
                        value: r.result

                    }).appendTo('#input-section');

                };
                r.onerror = function(error) {
                    console.log('Error: ', error);
                };

            });

            $('#input-id').on('fileremoved', function(event, id, index) {
                $('#' + id.replace(/[.|&;$%@"<>()+,]/g, "")).remove();
            });

            $('#input-id').on('filecleared', function(event) {
                $('.uploadcls').remove();
            });

        });
    </script>

    <?php
    if (isset($_POST)) {
        print_r($_POST['upload']);
    }
    ?>
</body>

</html>