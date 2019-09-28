<?php

include '../../../configuracion.php';

$arr = array();
$directory="../../../imagenes/ImgUpl/";
$dirint = dir($directory);
while (($archivo = $dirint->read()) !== false)
{
    if (eregi("gif", $archivo) || eregi("jpg", $archivo) || eregi("png", $archivo)){
        array_push($arr, $archivo);
    }
}
$dirint->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example: Browsing Files</title>
    <script>
        // Helper function to get parameters from the query string.
        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }
        // Simulate user action of selecting a file to be returned to CKEditor.
        function returnFileUrl(fileUrl) {

            var funcNum = getUrlParam( 'CKEditorFuncNum' );
            //var fileUrl = 'http://localhost/CubaMuseo/imagenes/Untitled.png';
            window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
            window.close();
        }
    </script>
</head>
<body>
    <div class="cui_row">
        <?php for($i=0; $i<count($arr); $i++){ ?>
        <img src="<?php echo Configuracion::$site.Configuracion::$imagenes; ?>ImgUpl/<?php echo $arr[$i]; ?>" style="float: left; height: 150px; margin: 10px;" onclick="returnFileUrl('<?php echo Configuracion::$site; ?>imagenes/ImgUpl/<?php echo $arr[$i]; ?>')" />
        <?php } ?>
    </div>
</body>
</html>