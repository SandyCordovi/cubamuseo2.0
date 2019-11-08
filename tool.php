<?php
function getFrame($f)
{
    switch ($f) {
        case "inicio":
            return "view/inicio.php";
            break;

        case "colecciones":
            return "view/colecciones/colecciones.php";
            break;
        case "seccion":
            return "view/colecciones/seccion.php";
            break;
        case "categoria":
            return "view/colecciones/categoria.php";
            break;

        case "estampas":
            return "view/estampas/estampas.php";
            break;			
		case "catestampa":
            return "view/estampas/estampacat.php";
            break;
		case "estampa":
            return "view/estampas/estampa.php";
            break;
		case "muestra":
            return "view/estampas/muestra.php";
            break;

        case "tienda":
            return "view/tienda/tienda.php";
            break;
        case "cattienda":
            return "view/tienda/cattienda.php";
            break;
	case "itemtienda":
            return "view/tienda/itemtienda.php";
            break;
        
        case "postales":
            return "view/vpost/postales.php";
            break;
        case "catpostales":
            return "view/vpost/catpostales.php";
            break;
		case "postalenviar":
            return "view/vpost/postalenviar.php";
            break;

        case "forum":
            return "view/forum/forum.php";
            break;
        case "forumtematica":
            return "view/forum/tematicas.php";
            break;
        case "forumitem":
            return "view/forum/item.php";
            break;

        case "search":
            return "view/search/search.php";
            break;
			
        default:
            return "view/colecciones/colecciones.php";
            break;
    }
}

function IsLogin()
{
    return isset ($_SESSION['cui_auth']) && $_SESSION['cui_auth']=="yes";
}


function getFrameAdmin($f)
{
    switch ($f) {
        case "inicio":
            return "view/inicio.php";
            break;
        case "rol":
            return "view/roles.php";
            break;
        case "user":
            return "view/usuarios.php";
            break;
        case "c_secciones":
            return "view/colecciones/seccion.php";
            break;
        case "c_categoria":
            return "view/colecciones/categoria.php";
            break;
        case "c_item":
            return "view/colecciones/item.php";
            break;
	case "c_texto":
            return "view/colecciones/texto.php";
            break;
	case "e_texto":
            return "view/estampas/texto.php";
            break;
        case "e_categoria":
            return "view/estampas/categoria.php";
            break;
        case "e_estampa":
            return "view/estampas/estampa.php";
            break;
        case "e_muestra":
            return "view/estampas/muestra.php";
            break;
        case "e_item":
            return "view/estampas/item.php";
            break;
	case "t_texto":
            return "view/tienda/texto.php";
            break;
	case "t_temat":
            return "view/tienda/tematica.php";
            break;
	case "t_item":
            return "view/tienda/item.php";
            break;
	case "v_texto":
            return "view/vpost/texto.php";
            break;
	case "v_postal":
            return "view/vpost/categoria.php";
            break;
        case "clientes":
            return "view/clientes.php";
            break;
        default:
            return "";
            break;
    }
}

function IsLoginAdmin()
{
    return isset ($_SESSION['cuiadmin_auth']) && $_SESSION['cuiadmin_auth']=="yes";
}




function getDateFormat($d)
{
    $now = new DateTime();
    $da = new DateTime($d);
    $wt = "0s";
    if ($da->diff($now)->format("%y")!=0) {
        $wt = $da->diff($now)->format("%y")." years";
    }
    else if ($da->diff($now)->format("%m")!=0) {
        $wt = $da->diff($now)->format("%m")." moth";
    }
    else if ($da->diff($now)->format("%d")!=0) {
        $wt = $da->diff($now)->format("%d")." days";
    }
    else if ($da->diff($now)->format("%H")!=0) {
        $wt = $da->diff($now)->format("%H")." h";
    }
    else if ($da->diff($now)->format("%i")!=0) {
        $wt = $da->diff($now)->format("%i")." min";
    }
    else if ($da->diff($now)->format("%s")!=0) {
        $wt = $da->diff($now)->format("%s")." s";
    }
    return $wt;
}

function getImgByUser($u)
{
    $img=file_exists('imguser/'.$u.'.jpg');
    if ($img) {
        return 'imguser/'.$u.'.jpg';
    }
    return 'images/user.png';
}

function getResumenName($n, $l)
{
    if (strlen($n)>$l) {
        return substr($n, 0, $l).'...';
    }
    return $n;
}

function getNotif($n)
{
    if($n==1)return 'Nombre de usuario o contasena incorrecto.';
    else if($n==2)return 'Este Usuario no existe.';
    else if($n==3)return 'Verifique sus datos. No puede haber ningun campo vacio';
    else if($n==4)return 'Ya existe un usuario con este email.';
    else if($n==5)return 'Ya puede comenzar a crear su recorrido.';

    else return '';
}

function getNotifTheme($n)
{
    if($n==1)return 'notif_bad';
    else if($n==2)return 'notif_bad';
    else if($n==3)return 'notif_info';
    else if($n==4)return 'notif_info';
    else if($n==5)return 'notif_ok';

    else return 'notif_info';
}

function RemplaceChart($old, $new, $txt)
{
    return preg_replace("/$old/", $new, $txt);
}

function UpLoadImg($img, $destino)
{
    $nombre_archivo = $img['name'];
    $tipo_archivo = $img['type'];
     if(!$nombre_archivo)
     {
         return FALSE;
     }
     else
     {
//        if (!$tipo_archivo)
//        {
//           return FALSE;
//        }
//        else
//        {
            if(!move_uploaded_file($img['tmp_name'], $destino.$nombre_archivo))
            {
                return FALSE;
            }
            return TRUE;
        //}
     }
}

function eliminarDir($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        //echo $archivos_carpeta;

        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }

    rmdir($carpeta);
}

function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry;
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}

function ValidaEmpty($f, $s)
{
    return $f==null || $f=="" ? $s : $f;
}

function getAllFileName($source)
{
    $arr = array();
    if ( is_dir( $source ) )
    {
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            array_push($arr, $entry);
        }
        $d->close();
    }
    return $arr;
}

?>
