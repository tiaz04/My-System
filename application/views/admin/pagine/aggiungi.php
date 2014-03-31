<script>
  $(document).ready(function(){
    $("#tobevalidate").validate();
  });
  </script>
<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/pagine') ?>">Pagine</a></li>
    <li class="active">Aggiungi Pagina</li>
</ol>
<h2>Inserimento Pagina</h2>
<?
$attributes = array('id' => 'tobevalidate');
echo form_open_multipart('admin/pagine/aggiungidb',$attributes);

?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Nome Pagina','nome','','class="form-control required"'); ?>
<? echo form_input_nci('Titolo','titolo','','class="form-control required"'); ?>
<? echo form_input_nci('Descrizione','descrizione'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Pagina','class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
</p>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Pagina";
if ($lista_pag!=""){
foreach ($lista_pag as $pag){
		$options["$pag->id_pagina"]=$pag->nome;
}
}
echo form_dropdown_nci('Pagina Padre','pagina_padre', $options, '0');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Categoria";
foreach ($lista_cat as $cat){
		$options["$cat->id_paginecat"]=$cat->nome;
}
echo form_dropdown_nci('Categoria','id_cat', $options, '0');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessun Header";
foreach ($headerimglist as $gallery){
		$options["$gallery->nome_gallery"]=$gallery->nome_gallery;
}
echo form_dropdown_nci('Header associato','header_img', $options, '0');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="No";
$options[1]="Si";

echo form_dropdown_nci('Nascondi Link','hidelink', $options, '0');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="No";
$options[1]="Si";

echo form_dropdown_nci('Nascondi In Menu','hideInMenu', $options, '0');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
foreach ($templates as $temp){
		$options["$temp->id"]=$temp->nome;
}

echo form_dropdown_nci('Template','template', $options, 1);?>
</div>
<div class="modulo">
<?php echo form_input_nci('Ordine','order','0');?>
</div>
<div class="modulo">
<?php echo form_input_nci('Link Diretto','directLink','');?>
</div>
<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Cat.Faq";
foreach ($catfaq_list as $catfaq){
		$options["$catfaq->id_faqcat"]=$catfaq->nome;
}

echo form_dropdown_nci('Categoria FAQ','id_faqcat', $options, 1);?>
</div>
    </div>
</div>


<?php echo form_close();?>