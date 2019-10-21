<?php
class Configuracion
{
    //////DB///////////////////////////
    static $host="localhost";
    static $database_name="cubamuseo";
    static $database_user="root";
    static $database_pass="";


    /////////////SITE////////////////////
    static $site = "http://cubamuseo.net/";
    static $imagenes = "imagenes/";
    static $images = "images/";
    static $temp = "temporales/";
    static $txt_ingles = "In Construction (available in spanish)";

    /////////////REDES SOCIALES////////////////////
    static $fb = 'http://www.facebook.com';
   
    ///////////PAGINACION///////////////
    static $fila_x_pag = 8;
    static $dimencion_navegacion = 480;
    static $num_elem_x_pag = 100;
    static $item_x_fila_gal = 8;

    //////////WEBMAIL////////////////////
    static $host_contacto = 'smtp.gmail.com';
    static $port_contacto = 587;
    static $username_contacto = 'cubamuseoserver@gmail.com';
    static $password_contacto = 'cubamuseoserver2019*';
    static $from_contacto = 'cubamuseoserver@gmail.com';
    static $fromName_contato = 'cubamuseo.net';

}
?>
