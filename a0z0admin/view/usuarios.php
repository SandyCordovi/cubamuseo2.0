<?php
include 'model/usuarios.php';

$usuarios = getUsuarios($_SESSION['cuiadmin_rol']);

?>
<div class="cui_row admin-contenedor">
    <h1 class="admin-titulo">USUARIOS</h1>
    <div class="cui_row" style="margin-top: 20px;">
        <div class="btn_admin" onclick="cui_wnd._createWND_tamFijo('wnd/usuarios.php?cmd=1&r=<?php echo $_SESSION['cuiadmin_rol']; ?>', 40);">
            Nuevo
        </div>
        <div class="btn_admin" onclick="EditBtn();">
            Editar
        </div>
        <div class="btn_admin_del" onclick="DeleteBtn();">
            Eliminar
        </div>
    </div>
    <div class="cui_row" style="margin-top: 20px;">
        <table class="grid">
          <thead>
            <tr>
              <th></th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0; $i<count($usuarios); $i++){ ?>
                <tr>
                      <td>
                          <input type="checkbox" data-r="<?php echo $_SESSION['cuiadmin_rol']; ?>" data-id="<?php echo $usuarios[$i]['id']; ?>" />
                      </td>
                      <td  onclick="Edit(<?php echo $usuarios[$i]['id']; ?>);">
                          <strong><?php echo utf8_decode($usuarios[$i]['nombre']); ?></strong>
                      </td>
                      <td  onclick="Edit(<?php echo $usuarios[$i]['id']; ?>);">
                        <?php echo utf8_decode($usuarios[$i]['email']); ?>
                      </td>
                      <td  onclick="Edit(<?php echo $usuarios[$i]['id']; ?>);">
                        <?php echo $usuarios[$i]['rol']; ?>
                      </td>
                      <td>
                          <img src="images/edit.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Edit" onclick="Edit(<?php echo $usuarios[$i]['id'] ?>, '<?php echo $roles[$i]['nombre'] ?>');" />
                          <img src="images/trash.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Delete" onclick="DeleteBtnId(<?php echo $usuarios[$i]['id'] ?>)" />
                      </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>

    <script>
        function DeleteBtn()
        {
            $(':input[type=checkbox]').each(function(){
                if(this.checked)
                {
                    txt = 'Estas seguro que quieres eliminar este elemento';
                    cui_wnd._createWND_tamFijo('wnd/MsgDlg.php?txt='+txt+'&func=DeleteElement('+$(this).data('id')+')', 40);
                }
            });
        }

         function DeleteBtnId(id)
        {
            txt = 'Estas seguro que quieres eliminar este elemento';
            cui_wnd._createWND_tamFijo('wnd/MsgDlg.php?txt='+txt+'&func=DeleteElement('+id+')', 40);
        }

        function DeleteElement(id)
        {
            $.ajax({
                url : 'controller/usuarios.php',
                type: "POST",
                data : 'cmd=3&id='+id,
                success:function(data, textStatus, jqXHR)
                {
                    window.location="";
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }
            });
        }

        function EditBtn()
        {
            $(':input[type=checkbox]').each(function(){
                if(this.checked)
                {
                    Edit($(this).data('id'), $(this).data('nombre'));
                }
            });
        }

        function Edit(id)
        {
            cui_wnd._createWND_tamFijo('wnd/usuarios.php?cmd=2&id='+id+'&r=<?php echo $_SESSION['cuiadmin_rol']; ?>', 40);
        }

        $(':input[type=checkbox]').click(function(){
            $(':input[type=checkbox]').each(function(){
                this.checked = false;
            });
            this.checked = true;
        });

    </script>

</div>