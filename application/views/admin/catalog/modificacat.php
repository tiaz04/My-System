<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/catalog/listacat') ?>">Categorie Prodotti</a></li>
    <li class="active">Modifica Categoria Prodotti</li>
</ol>
<h2>Modifica Categoria Prodotti</h2>
<?
echo form_open('admin/catalog/modificacatdb/'.$catpagine[0]->id_catalogcat);

?>
<div class="row">
<div class="col-sm-9">
<? echo form_input_nci('Nome Categoria','nome',$catpagine[0]->nome, 'class="required form-control"'); ?>
    <? echo form_input_nci('Descrizione Categoria','descrizione', $catpagine[0]->descrizione, 'class="required form-control"'); ?>
<? echo form_input_nci('Link','rewrite',$catpagine[0]->cat_rewrite, 'class="required form-control"'); ?>
</div>
<div class="col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
    <? echo form_submit('mysubmit', 'Modifica Categoria', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
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
            echo form_dropdown_nci('Categoria Padre', 'cat_padre', $options, $catpagine[0]->cat_padre);
            ?>
        </div>
</div>
    </div>

