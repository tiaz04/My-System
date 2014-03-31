<h2>Inserimento Elemento Glossario</h2>
<?
echo form_open_multipart('admin/glossario/aggiungidb');
?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Elemento','class="buttonclass"'); ?>
</p>
</div>

</div>
<div class="col_cen">
<? echo form_input_nci('Nome Elemento','testo'); ?>
</div>

