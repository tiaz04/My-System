<h2>Modifica Menu</h2>
<?
echo form_open('admin/menu/modificadb/'.$menu[0]->id_menu);

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Menu','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Nome Menu','nome',$menu[0]->nome_menu); ?>

</div>
