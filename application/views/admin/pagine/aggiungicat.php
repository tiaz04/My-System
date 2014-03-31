<h2>Inserimento Categoria</h2>
<?

echo form_open_multipart('admin/pagine/aggiungicatdb');

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Categoria','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Nome Categoria','nome'); ?>
</div>
<?php echo form_close();?>