<h2>Inserimento Video Gallery</h2>
<?

echo form_open_multipart('admin/video/aggiungidb');

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Videogallery','class="buttonclass"'); ?>
</p>
</div>

</div>
<div class="col_cen">
<? echo form_input_nci('Nome Videogallery','nome'); ?>
<? echo form_textarea_nci('Descrizione','descrizione'); ?>
</div>
