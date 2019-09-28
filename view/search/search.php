<?php

$s = "";
if( isset ($_POST['box_search_index']) && $_POST['box_search_index'])
{
    $s = $_POST['box_search_index'];
}

?>

<style type="text/css">
    .cui_tabs_btns
    {
        border-bottom: 1px solid #8fd0a6;
    }
    .cui_tab_btn
    {
        padding: 4px 12px; position: relative;
    }
    .cui_tab_btn_activo
    {
        border-bottom: 3px solid #8fd0a6;
    }
    span:hover{
        border-bottom: none;
    }
</style>

<script type="text/javascript" src="lib/jquery/jquery.form.min.js"> </script>
<script type="text/javascript" src="script/search/search.js"> </script>
<div class="cui_row cui_smart_search" style="min-height: 500px;">
    <div class="cui_row">
        <form id="myFormSearch" action="#" method="post" style="width: 80%; height: 50px; background-color: #9dd7d3; margin: 50px auto; padding: 0  10px 0 10px; position: relative;">
            <input name="box_search" class="cui_input_search" value="<?php echo  $s;?>" placeholder="Buscar en Cuba Museo" style="float: left; margin: 0; border: none; background-color: transparent; height: 100%; color: black; width: 100%; padding: 0 30px; background-position: center right;" />
            <div class="cui_intellisense" style="display: none; position: absolute; width: 100%; z-index: 5; max-height: 300px; overflow: auto; background-color: #efefef; margin: 0; left: 0; top: 50px;">
                
            </div>
            <input type="submit" style="display: none; visibility: collapse;" />
        </form>
    </div>
    <div class="cui_row cui_result">
        <div class="cui_w">
            <div class="cui_tabs">
                <div class="cui_tabs_btns" style="border-bottom: none">
                    <div href="#colecciones" class="cui_tab_btn cui_tab_btn_activo">Colecciones</div>
                    <div href="#estampa" class="cui_tab_btn cui_tabs_search">Estampas</div>
                    <div href="#tienda" class="cui_tab_btn cui_tabs_search">Tienda</div>
<!--                    <div href="#forum" class="cui_tab_btn" style="margin-left: 200px;">Forum</div>-->
                </div>
                <div id="colecciones" class="cui_tabs_content tab_cont_activo cui_padding_20 cui_padding_50_bottom">

                    <div class="cui_generalload" style="padding: 20px 0; z-index: 4;">
                        <div class="wrapper">
                            <div class="cssload-loader"></div>
                        </div>
                     </div>

                    <div class="cui_row cui_result" style="display: none;">

                    </div>

                </div>
                <div id="estampa" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">

                    <div class="cui_generalload" style="padding: 20px 0;">
                        <div class="wrapper">
                                <div class="cssload-loader"></div>
                        </div>
                     </div>

                    <div class="cui_row cui_result">

                    </div>

                </div>
                <div id="tienda" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">

                    <div class="cui_generalload" style="padding: 20px 0;">
                        <div class="wrapper">
                                <div class="cssload-loader"></div>
                        </div>
                     </div>

                    <div class="cui_row cui_result">

                    </div>

                </div>
<!--                <div id="forum" class="cui_tabs_content cui_padding_20 cui_padding_50_bottom">

                    <div class="cui_generalload" style="padding: 20px 0;">
                        <div class="wrapper">
                                <div class="cssload-loader"></div>
                        </div>
                     </div>

                    <div class="cui_row cui_result">

                    </div>

                </div>-->
        </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

            var cuiSearch = new $.cuiSearch({

            }, '.cui_smart_search');
            
            $('.cui_tab_btn').on('click', function(){
                 clickTabs(this);
            });

	});
	</script>