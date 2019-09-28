<?php
class cuiLang
{
    var $Lang = "es";
    var $es = array();
    var $us = array();

    public function __construct($l)
    {
       if($l)$this->Lang = $l;
    }

    function getLangName()
    {
        if($this->Lang=='es')return 'Espa&ntilde;ol';
        if($this->Lang=='en')return 'English';
        return 'Espa&ntilde;ol';
    }

    function getLangISO()
    {
        if($this->Lang=='es')return '';
        if($this->Lang=='en')return '-en';
        return '';
    }
	
    function getLang()
    {
        if($this->Lang=='es')return 'es';
        if($this->Lang=='en')return 'en';
        return 'es';
    }

    function getIndex($id)
    {
        $this->es["menu1"]="INICIO";
        $this->es["menu2"]="INICIO";
        $this->es["menu3"]="ESTAMPAS";
        $this->es["menu4"]="V-POSTS";
        $this->es["menu5"]="TIENDA";
        $this->es["menu6"]="FORUM";
        $this->es["derechos"]="Todos los derechos reservados.";
        $this->es["foot1"]="CONTACTENOS";
        $this->es["foot2"]="QUIENES SOMOS";
        $this->es["foot3"]="NOTICIAS";
        $this->es["foot4"]="SITIOS RELACIONADOS";
        $this->es["foot5"]="TERMINOS";
                

        $this->us["menu1"]="HOME";
        $this->us["menu2"]="HOME";
        $this->us["menu3"]="TALES";
        $this->us["menu4"]="V-POSTS";
        $this->us["menu5"]="STORE";
        $this->us["menu6"]="FORUM";
        $this->us["derechos"]="All rights reserved.";
        $this->us["foot1"]="CONTACT US";
        $this->us["foot2"]="ABOUT US";
        $this->us["foot3"]="NEWS";
        $this->us["foot4"]="RELATED SITES";
        $this->us["foot5"]="TERMS";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

    function getHome($id)
    {
        $this->es["tit1"]="Cuba Museo";
        $this->es["text1"]="Es un proyecto que se propone conformar gradualmente un espacio virtual dedicado a recrear el pasado cubano, exponiendo mediante p&aacute;ginas tem&aacute;ticas con sus correspondientes galer&iacute;as muestras similares a las que usted podr&iacute;a disfrutar durante la visita a un museo real.
Ser&aacute; este un sitio eminentemente cultural, sin intenciones o inclinaciones pol&iacute;ticas de ning&uacute;n tipo, que se limitar&aacute; a describir y reproducir digitalmente, de forma sucinta y objetiva, la amplia gama de piezas que por sus caracter&iacute;sticas resultan de inter&eacute;s para el &aacute;mbito coleccionista.  
Muestras dedicadas a la numism&aacute;tica, las artes gr&aacute;ficas, la filatelia, la vitolfilia, la pintura y la escultura, la fotograf&iacute;a, etc., tan ligadas todas al patrimonio cultural del país.";
        $this->es["tit2"]="Colecciones";
        $this->es["text2"]="Coraz&oacute;n de nuestro sitio, donde se expondr&aacute;n colecciones de diversos g&eacute;neros agrupadas por tem&aacute;ticas.";
        $this->es["tit3"]="Estampas";
        $this->es["text3"]="Donde a partir de viejas im&aacute;genes conformaremos peque&ntilde;as p&aacute;ginas con rese&ntildeas de inter&eacute;s para amantes del pasado cubano y coleccionistas.";
        $this->es["tit4"]="V-Posts";
        $this->es["text4"]="Secci&oacute;n que como muchas otras existentes en la red le ofrecer&aacute; la posibilidad de enviar tarjetas virtuales de felicitaci&oacute;n, en este caso aquellas tarjetas postales antiguas que enviaban nuestros abuelos";
        $this->es["tit5"]="Tienda";
        $this->es["text5"]="Donde comercializaremos piezas antiguas de diversos g&eacute;neros recibidas a comisi&oacute;n de manos de usuarios y coleccionistas destacados.";
        $this->es["tit6"]="Forum";
        $this->es["text6"]="-";

        $this->us["tit1"]="Cuba Museo";
        $this->us["text1"]="Is a project whose main purpose is to gradually create a virtual space dedicated to recreate the Cuban past. It will exhibit through thematic pages, with their corresponding galleries, samples similar to those you could enjoy during a visit to a real museum.
This will be a purely cultural site, with no political intentions or tendencies of any kind. It will be restricted to digitally reproduce in a concise and objective way the wide variety of pieces that according to their characteristics turn out to be of interest for the field of collecting.
It is important to make it clear that on this first stage, we will limit ourselves to exhibit only the samples belonging to the colonial and republican period of the everyday Cuban life, so we will cover only what is known as the pre-embargo era.
Exhibits dedicated to numismatics, graphic arts, philately, vitolfilia (the art of collecting cigar bands, labels), painting and sculpture, photography, etc.., all so tied to the cultural heritage of a country, will be gradually incorporated into this space initially made up of the following sections:";
        $this->us["tit2"]="Collections";
        $this->us["text2"]="Heart of our site, where the  different collections  will be digitally exhibited grouped by subjects.";
        $this->us["tit3"]="Tales";
        $this->us["text3"]="Parting from specific images, small pages will be made up containing tales of interest for collectors.";
        $this->us["tit4"]="V-Posts";
        $this->us["text4"]="Section that like many others in the network will offer the possibility to send virtual greeting cards, in this case those old postcards our grandparents used to send.";
        $this->us["tit5"]="Store";
        $this->us["text5"]="Where we will sell different kinds of items on a commission basis received from collectors and associates.";
        $this->us["tit6"]="Forum";
        $this->us["text6"]="-";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

    function getGaleria($id)
    {
        $this->es["tab1"]="Descripci&oacute;n";
        $this->es["tab2"]="Galer&iacute;a de p&#225ginas";
        $this->es["tab3"]="Galer&iacute;a Imagenes";
        $this->es["sm1"]="Ver";
        $this->es["sm2"]="Ver Detalle";
        $this->es["sm3"]="Ver imagen ampliada";
        $this->es["sm4"]="Ver galer&iacute;a completa";
        $this->es["sm5"]=" de ";

        $this->us["tab1"]="Description";
        $this->us["tab2"]="Gallery";
        $this->us["tab3"]="Gallery Image";
        $this->us["sm1"]="View";
        $this->us["sm2"]="View Details";
        $this->us["sm3"]="View enlarged image";
        $this->us["sm4"]="View full gallery";
        $this->us["sm5"]=" of ";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

	 function getTienda($id)
    {
        $this->es["ck1"]="Env&iacute;o dentro de EE. UU.";
        $this->es["ck2"]="Env&iacute;o fuera de EE. UU.";
		$this->es["v"]="Contactar con el vendedor";
        
        $this->us["ck1"]="Shipping inside US";
        $this->us["ck2"]="Shipping outside US";
		$this->us["v"]="Contact the seller";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }
	function getVpost($id)
    {
        $this->es["t1"]="Seleccionar";
        $this->es["t2"]="Ver imagen ampliada";
		        
        $this->us["t1"]="Select";
        $this->us["t2"]="View enlarged image";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }
	
    function getWnd($id)
    {
        $this->es["c1"]="Emisi&oacute;n";
        $this->es["c2"]="Color";
        $this->es["c3"]="Material";
        $this->es["c4"]="Impresi&oacute;n";
        $this->es["c5"]="Dimensiones del original";
        $this->es["c6"]="Usted puede adquirir esta imagen en grandes dimensiones ";
        $this->es["c7"]=" en formato jpg, a 300 dpi y sin marca de agua por un precio de ";
        $this->es["b1"]="Esta imagen esta en su carrito.";
        $this->es["b2"]="Ver carrito";
        $this->es["b3"]="Adicionar al carrito";
		$this->es["b4"]="Este item esta en su carrito.";
        $this->es["l1"]="Para poder comprar este item debe iniciar sesi&oacute;n";
        $this->es["l2"]="introducir nombre de usuario y contrase&ntilde;a";
        $this->es["img"]="Ver imagen ampliada";

        $this->us["c1"]="Emision";
        $this->us["c2"]="Color";
        $this->us["c3"]="Material";
        $this->us["c4"]="Impresion";
        $this->us["c5"]="Original's dimensions";
        $this->us["c6"]="You can get this image in larger dimensions ";
        $this->us["c7"]=" in jpg format, in 300 dpi and without water mark, for a price of ";
        $this->us["b1"]="This image is in your cart";
        $this->us["b2"]="View Cart";
        $this->us["b3"]="Add to cart";
		$this->us["b4"]="This item is in your cart.";
        $this->us["l1"]="For buying this item you have to sign in";
        $this->us["l2"]="use your username and your password";
        $this->us["img"]="View enlarged image";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

	function getContacto($id)
    {
        $this->es["slogan1"]="NO DUDE EN...";
        $this->es["slogan2"]="CONTACTARNOS";
        $this->es["texto"]="Puede ponerse en contacto con nosotros directamente llamando al <span style='color:#252525; font-size: 25px;'>(+53) 5333 46 58</span> o completando el siguiente formulario.";
        $this->es["name"]="Nombre";
        $this->es["mail"]="Correo electr&oacute;nico";
        $this->es["asunto"]="Asunto";
        $this->es["mensaje"]="Mensaje";
        $this->es["enviar"]="Enviar";

        $this->us["slogan1"]="DO NOT HESITATE TO...";
        $this->us["slogan2"]="CONTACT US";
        $this->us["texto"]="You can contact us directly at <span style='color:#252525; font-size: 25px;'>(+53) 5333 46 58</span> or if you prefer filling in the contact form below.";
        $this->us["name"]="Name";
        $this->us["mail"]="Email";
        $this->us["asunto"]="Subject";
        $this->us["mensaje"]="Message";
        $this->us["enviar"]="Submit";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
        
    }

    function getLogin($id)
    {       
        $this->es["entrar"]="Entrar";
        $this->es["crear"]="Crear Cuenta";
        $this->es["email"]="Correo Electr&oacute;nico";
        $this->es["name"]="Nombre y Apellidos";
		$this->es["username"]="Nombre de Usuario";
        $this->es["pass"]="Contrase&ntilde;a";
        $this->es["sesion"]="No cerrar la sesi&oacute;n";
        $this->es["olvidar"]="Ha olvidado su contrase&ntilde;a?";
		$this->es["texto"]="Auacute;n no tienes cuenta en Cubamuseo?";
		$this->es["texto2"]="Crear una cuenta en CubaMuseo es gratis";
        
        $this->us["entrar"]="Sign In";
        $this->us["crear"]="Create Account";
        $this->us["email"]="Email";
        $this->us["name"]="Name";
		$this->us["username"]="Username";
        $this->us["pass"]="Password";
        $this->us["sesion"]="Keep me logged";
        $this->us["olvidar"]="Forgot your password?";
		$this->us["texto"]="Are you registered in CubaMuseo?";
		$this->es["texto2"]="Register in CubaMuseo is free";
        
        
        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

    function getNotif($id)
    {
        $this->es["1"]="Nombre de usuario o contase&ntilde;a incorrecto.";
        $this->es["2"]="Este usuario no existe.";
        $this->es["3"]="Verifique sus datos. No puede haber ning&uacute;n campo vac&iacute;fo.";
        $this->es["4"]="Ya existe un usuario con este email.";
        $this->es["5"]="Ya puede comenzar a crear su recorrido.";
        $this->es["6"]="Su mensaje ha sido enviado correctamente. En breve le atenderemos.";
        $this->es["7"]="Ha ocurrido un error al enviar el mensaje de contacto. Vuelva a intentarlo, gracias.";

        $this->us["1"]="Username or password is incorrect.";
        $this->us["2"]="This user does not exist.";
        $this->us["3"]="Verify your information. There can be no empty field.";
        $this->us["4"]="A user with this email already exists.";
        $this->us["5"]="You can now start creating your route.";
        $this->us["6"]="Your message has been sent successfully. Shortly we will respond.";
        $this->us["7"]="An error has occurred sending the message. Try again, thank you.";

        if($this->Lang=="es")return $this->es[$id];
        else return $this->us[$id];
    }

    
}

?>
