<h2>Modifica Videogallery</h2>
<?
echo form_open('admin/video/modificadb/'.$videogallery[0]->id_videogallery);

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Videogallery','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Nome Videogallery','nome',$videogallery[0]->nome); ?>
<? echo form_textarea_nci('Descrizione','descrizione',$videogallery[0]->descrizione); ?>
</div>
