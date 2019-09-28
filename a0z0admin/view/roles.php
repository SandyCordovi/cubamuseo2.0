<?php
include 'model/roles.php';

$roles = getRoles($_SESSION['cuiadmin_rol']);
?>
<div class="cui_row admin-contenedor">
    <h1 class="admin-titulo">ROLES</h1>
    <div class="cui_row" style="margin-top: 20px;">
        <div class="btn_admin" onclick="cui_wnd._createWND_tamFijo('wnd/roles.php?cmd=1', 40);">
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
              <th>Rol</th>
              <th>Alcance</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0; $i<count($roles); $i++){ ?>
                <tr>
                      <td>
                          <input type="checkbox" data-nombre="<?php echo $roles[$i]['nombre'] ?>" data-id="<?php echo $roles[$i]['id'] ?>" />
                      </td>
                      <td >
                          <strong><?php echo $roles[$i]['nombre'] ?></strong>
                      </td>
                      <td>
                        <?php echo $roles[$i]['id'] ?>
                      </td>
                      <td>
                          <img src="images/edit.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Edit" onclick="Edit(<?php echo $roles[$i]['id'] ?>, '<?php echo $roles[$i]['nombre'] ?>');" />
                          <img src="images/trash.png" height="20px" style="float: left; margin: 0 5px; cursor: pointer;" title="Delete" onclick="DeleteBtnId(<?php echo $roles[$i]['id'] ?>)" />
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
                url : 'controller/roles.php',
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
        
        function Edit(id, nombre)
        {
            cui_wnd._createWND_tamFijo('wnd/roles.php?cmd=2&id='+id+'&nombre='+nombre, 40);
        }
        
        $(':input[type=checkbox]').click(function(){
            $(':input[type=checkbox]').each(function(){
                this.checked = false;
            });
            this.checked = true;
        });
        
    </script>
</div>
