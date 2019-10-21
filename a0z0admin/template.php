<?php
include 'model/template.php';

$f="inicio";
if(isset ($_GET['f']) && $_GET['f'])
{
    $f = $_GET['f'];
}
$dir = getFrameAdmin($f);

$menu = getMenuByRol($_SESSION['cuiadmin_rol']);
?>

<div class="cui_wndfixed"></div>
 <div class="cui_wndabsolut">

 </div>

<div class="cui_row" style="height: 100%;">
    
    <div class="banda-menu">
        <ul class="menu-admin">
            <li>
                <h1>Cui Admin</h1>
            </li>
            <li>
                <a href="controller/logout.php" title="Salir"><p class="name text-truncate"><?php echo $_SESSION['cuiadmin_name']; ?></p></a>
            </li>
            <li>
                <div class="separador"></div>
            </li>

            <li class="link<?php echo "inicio"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=inicio" style="font-size: 18px;">Inicio</a>
            </li>

            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">ADMINISTRATIVA</p>
            </li>
            <li class="link<?php echo "rol"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>1 ? 'oculto' : '' ?>">
                <a href="?f=rol">Rol</a>
            </li>
            <li class="link<?php echo "user"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=user">Usuarios</a>
            </li>
            

            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">TEMÁTICAS</p>
            </li>
            <li class="link<?php echo "c_secciones"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=c_secciones">Secciones</a>
            </li>
            <li class="link<?php echo "c_categoria"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=c_categoria">Paginas</a>
            </li>
            <li class="link<?php echo "c_item"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=c_item">Imagenes</a>
            </li>
            <li class="link<?php echo "c_texto"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=c_texto">Texto</a>
            </li>


            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">ESTAMPAS</p>
            </li>
            <li class="link<?php echo "e_categoria"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=e_categoria">Categorias</a>
            </li>
            <li class="link<?php echo "e_estampa"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=e_estampa">Estampas</a>
            </li>
            <li class="link<?php echo "e_muestra"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=e_muestra">Muestras</a>
            </li>
            <li class="link<?php echo "e_texto"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=e_texto">Texto</a>
            </li>


            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">V-POST</p>
            </li>
            <li class="link<?php echo "e_categoria"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=v_postal">Postales</a>
            </li>
            <li class="link<?php echo "v_texto"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=v_texto">Texto</a>
            </li>


            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">TIENDA</p>
            </li>
            <li class="link<?php echo "t_temat"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=t_temat">Temáticas</a>
            </li>
            <li class="link<?php echo "t_item"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>3 ? 'oculto' : '' ?>">
                <a href="?f=t_item">Items</a>
            </li>
            <li class="link<?php echo "t_texto"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=t_texto">Texto</a>
            </li>


            <li class="caption <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <p class="caption" style="font-weight: bold">GENERALES</p>
            </li>
            <li class="link<?php echo "clientes"==$f ? " linkactivo" : "" ?> <?php echo $_SESSION['cuiadmin_rol']>2 ? 'oculto' : '' ?>">
                <a href="?f=clientes">Clientes</a>
            </li>

        </ul>
    </div>

    <div class="banda-contenido">
        <?php include $dir; ?>
    </div>
</div>

<script type="text/javascript">

   var cui_wnd = new $.cuiWND({}, '.cui_wndabsolut');

</script>