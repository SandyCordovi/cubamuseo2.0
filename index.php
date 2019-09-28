<?php
session_start();

include 'configuracion.php';
include 'tool.php';
include 'accesdb/model.php';
include 'accesdb/cui_generales.php';
include 'modulos/lang.php';
include 'lib/rsa.php';

if(isset ($_GET['f']) && $_GET['f'])
{
    $f = $_GET['f'];
}
else
    $f="colecciones";

$param = preg_split('/-/', $f);
$f = $param[0];
$dir = getFrame($f);

$pl_es=$f;
$pl_us=$f;

$lang = 'es';



if(count($param)>1)
{    
	if($param[1]=='es' || $param[1]=='en')
	{
		$lang = $param[1];
		$pl_es = $pl_es.'-es';
		$pl_us = $pl_us.'-en';
	}
	for($i=2; $i < count($param); $i++)
	{		
		$pl_es = $pl_es.'-'.$param[$i];
		$pl_us = $pl_us.'-'.$param[$i];
	}
}
else
{
	$pl_es = $pl_es.'-es';
	$pl_us = $pl_us.'-en';
}
$clang = new cuiLang($lang);

if(isset($_COOKIE['id_extreme']))
{
    $cookie = htmlentities($_COOKIE['id_extreme']);
    $user = getUserByIdExtreme($cookie);
    if($user)
    {
        $_SESSION['auth'] = "yes";
        $_SESSION['email'] = $user['email'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['id_extreme'] = $user['id_extreme'];
        $_SESSION['username'] = $user['username'];
    }
}

setVisita();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <meta charset="utf-8">

        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="" />
        <meta name="title" content="CubaMuseo.NET" />
        <meta name="author" content="CubaMuseo.NET" />
        <meta name="owner" content="Cuinfinity"/>
        <meta name="description" content=""/>

        <title>Cuba Museo</title>
        <!--        Nuevo estilo-->
        <!--Side bar -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>



<!--        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="screen">-->
        <link rel="stylesheet" type="text/css" href="css/magnific-popup.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="screen">
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">

        <!--        Nuevo estilo final-->
        <link rel="icon" href="http://cubamuseo.net/images/logo.png"/>
        <link rel="stylesheet" href="style/style.css"/>
        <script type="text/javascript" src="lib/jquery/jquery-1.10.2.js"> </script>
        <script type="text/javascript" src="lib/jquery/jquery.form.min.js"> </script>
        <script type="text/javascript" src="lib/cui_wnd.js"> </script>
        <script type="text/javascript" src="script/cui_script.js"> </script>


<!--        <script type="text/javascript" src="js/bootstrap.js"></script>-->

<!--        <script type="text/javascript" src="js/retina-1.1.0.min.js"></script>-->
<!--        <script type="text/javascript" src="js/plugins-scroll.js"></script>-->
<!--        <script type="text/javascript" src="js/waypoint.min.js"></script>-->
<!--        <script type="text/javascript" src="js/script.js"></script>-->

        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <style type="text/css">
            .container{
                padding-left: 5%;
                padding-right: 5%;
            }
            .navbar-toggler-icon:hover{
                border-bottom: none;
            }

        </style>
    </head>
    <body>
         <div class="cui_wndfixed"></div>
         <div class="cui_wndabsolut">
             
         </div>

         <header class="clearfix" style="max-width: 90%;left: 5%">
             <!-- Static navbar -->
             <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="border-bottom: 1px solid #f1f1f1 !important;" >
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#" style="padding: 0"><img alt="" src="images/logocm.png" style="max-height: 100px"></a>
                 </div>

                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>

                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto " style="margin: 0">
                         <li>
                             <a href="?f=colecciones<?php echo $clang->getLangISO(); ?>"><?php echo $clang->getIndex('menu2'); ?></a>
                         </li>
                         <li>
                             <a href="?f=estampas<?php echo $clang->getLangISO(); ?>" ><?php echo $clang->getIndex('menu3'); ?></a>
                         </li>
                         <li>
                             <a href="?f=postales<?php echo $clang->getLangISO(); ?>" ><?php echo $clang->getIndex('menu4'); ?></a>
                         </li>
                         <li>
                             <a href="?f=tienda<?php echo $clang->getLangISO(); ?>" ><?php echo $clang->getIndex('menu5'); ?></a>
                         </li>
                         <li>
                             <a href="?f=forum<?php echo $clang->getLangISO(); ?>" ><?php echo $clang->getIndex('menu6'); ?></a>
                         </li>
                     </ul>


                 </div>

             </nav>
             <div class="nav" style="background-color: #fff;height: 40px;" >
                 <ul class="navbar-nav" style="width: 100%; margin: 0">
                     <li style="width: 100%; margin-left: 0">

                         <a style="float: right;padding: 0;margin-top: 10px;" class="link-lang" href="?f=<?php echo $pl_us; ?>"><img src="images/eng.png" height="18px" alt="ENG"/></a>
                         <a style="float: right;padding: 0;margin-top: 10px;" href="?f=<?php echo $pl_es; ?>"><img height="18px" src="images/esp.png" alt="ESP"/></a>
                         <a style="float: right; margin-right: 20px;margin-top: 10px;padding: 0" id="cui_search" style="position: absolute" href="#">
                             <img src="images/lupan.png" height="18px" alt="Buscar en CubaMuseo" title="Buscar en CubaMuseo" />
                         </a>
                         <form id="cui_search_box" action="?f=search" method="post" style="border-radius: 20px; background-color: rgb(245, 245, 245);" target="_blank">
                             <div>
                                 <input name="box_search_index" class="cui_input_search" placeholder="Buscar en CubaMuseo" />
                                 <div id="close_search_box" class="cui_input_closesearch" ></div>
                             </div>
                         </form>

                             <button class="btn" style="float: left; " id="menu-toggle"><i id="menu_toggle_icon" class="fa fa-arrow-right" style="font-size: 26px;color: #a1d9d7"></i></button>

                     </li>

                 </ul>

             </div>



         </header>


    <div id="content">
        <div class="section-content">

            <div class="cui_row cui_rolmain" role="main">
                <?php include $dir; ?>
            </div>
        </div>

    </div>

         <script type="text/javascript">
             $(document).ready(function() {
                 /*
                 var defaults = {
                       containerID: 'toTop', // fading element id
                     containerHoverID: 'toTopHover', // fading element hover id
                     scrollSpeed: 1200,
                     easingType: 'linear'
                  };
                 */

                 $().UItoTop({ easingType: 'easeOutQuart' });

             });
         </script>
         <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>



        <footer class="cui_row">

			<div class="cui_row" style="text-align:center; font-size:.8em;">
				
				<a id="cui_cont" href="#" class="cui_menu_footer"><?php echo $clang->getIndex('foot1'); ?></a>						
				<a id="cui_quien" href="#" class="cui_menu_footer"><?php echo $clang->getIndex('foot2'); ?></a>
				<a id="cui_news" href="#" class="cui_menu_footer"><?php echo $clang->getIndex('foot3'); ?></a>						
				<a id="cui_sitios" href="#" style="border-right: none" class="cui_menu_footer"><?php echo $clang->getIndex('foot4'); ?></a>
<!--				<a id="cui_terminos" href="#" class="cui_menu_footer" style="border:none;">--><?php //echo $clang->getIndex('foot5'); ?><!--</a>-->
					
			</div>			
			<div class="cui_row" style="padding-top:20px; font-size: .85em;">
				CubaMuseo &copy; <?php echo $clang->getIndex('derechos'); ?> <a href="http://www.cuinfinity.com" target="_BLANK"><i>Dise&ntilde;o y Desarrollo por Cuinfinity</i></a>
			</div>
        </footer>

         <script type="text/javascript">
            var cui_wnd = new $.cuiWND({}, '.cui_wndabsolut');

            $('.navbar-toggler').on('click', function(e){
                e.preventDefault();
                if($("#navbarSupportedContent")[0].attributes.length > 2){
                    if($("#navbarSupportedContent")[0].attributes[2].nodeValue == "display: block;")
                        $("#navbarSupportedContent").hide();
                    else
                        $("#navbarSupportedContent").show();
                }else
                        $("#navbarSupportedContent").show();


            });

            $('#cui_entrar').on('click', function(e){
                e.preventDefault();
                if($(this).hasClass('user_log'))
                    cui_wnd._createWND_tamFijo('dlg/opt_user.php', 30);
                else
                    cui_wnd._createWND_tamFijo('dlg/login.php', 30);
            });
            $('#cui_search').on('click', function(e){
                e.preventDefault();
                $('#cui_search_box').css('width', '77%');
                $('#cui_search_box').css('margin-right', '75px');
                $('#cui_search').css('display', 'none');
                //$('#menu-toggle').css('display', 'none');
            });
            $('#close_search_box').on('click', function(e){
                e.preventDefault();
                $('#cui_search_box').css('width', '0px');
                $('#cui_search').css('display', 'block');
                // $('#menu-toggle').css('display', 'block');
            });
            $('#cui_cart').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/cart.php', 50);
            });
            $('#cui_cont').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/contacto.php', 40);
            });
            $('#cui_quien').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/quienes.php', 50);
            });
            $('#cui_sitios').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/sitios.php', 50);
            });
            $('#cui_news').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/noticia.php', 50);
            });
            $('#cui_terminos').on('click', function(e){
                e.preventDefault();
                cui_wnd._createWND_tamFijo('dlg/terminos.php', 50);
            });

            $('#menu-toggle').on('click',function (e) {
                e.preventDefault();

                if($('#menu_toggle_icon').attr("class")=="fa fa-arrow-right"){
                    $('#menu_toggle_icon').removeClass("fa fa-arrow-right");
                    $('#menu_toggle_icon').addClass("fa fa-arrow-left");
                }
                else{
                    $('#menu_toggle_icon').removeClass("fa fa-arrow-left");
                    $('#menu_toggle_icon').addClass("fa fa-arrow-right");
                }

            })

        </script>

    </body>
</html>