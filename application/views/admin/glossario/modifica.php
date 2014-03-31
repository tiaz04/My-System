<h2>Modifica Glossario</h2>
<?
echo form_open_multipart('admin/glossario/modificadb/'.$glossario[0]->id);
?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Elemento','class="buttonclass"'); ?>
</p>
</div>

</div>
<div class="col_cen">
<? echo form_input_nci('Nome Elemento','testo',$glossario[0]->testo); ?>


</div>
