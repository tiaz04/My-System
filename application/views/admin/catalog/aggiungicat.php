<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/catalog/listacat') ?>">Categorie Prodotto</a></li>
    <li class="active">Aggiungi Categoria Prodotto</li>
</ol>
<h2>Inserimento Categoria</h2>
<?

echo form_open_multipart('admin/catalog/aggiungicatdb');

?>
<div class="row">
<div class="col-sm-9">
<? echo form_input_nci('Nome Categoria','nome', '', 'class="required form-control"'); ?>
    <? echo form_input_nci('Descrizione Categoria','descrizione', '', 'class="required form-control"'); ?>
</div>
<div class="col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
    <? echo form_submit('mysubmit', 'Pubblica Categoria', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>

</p>
</div>
    <div class="modulo">
            <?php
            /* INSERISCO LE CATEGORIE NEL DROPBOX */
            $options = Array();
            $options[0] = "Nessun padre";
            foreach ($lista_cat as $cat) {
                
                if ($cat->cat_padre == 0){
                
                $options["$cat->id_catalogcat"] = $cat->nome;
                
                
                foreach ($lista_cat as $cat2) {
                    
                     if ($cat2->cat_padre == $cat->id_catalogcat){
                         
                         $options["$cat2->id_catalogcat"] = "- ".$cat2->nome;
                     }
                }
                
                
                }
            }
            echo form_dropdown_nci('Categoria Padre', 'cat_padre', $options, '0');
            ?>
        </div>
</div>
</div>
<?php echo form_close();?>