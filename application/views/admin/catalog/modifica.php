<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/catalog') ?>">Prodotto</a></li>
    <li class="active">Modifica Prodotto</li>
</ol>
<h2>Modifica Prodotto</h2>
<?
echo form_open_multipart('admin/catalog/modificadb/' . $catalog[0]->id_catalog);

$data_giorno = date('j', $catalog[0]->data);
$data_mese = date('n', $catalog[0]->data);
$data_anno = date('Y', $catalog[0]->data);
?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Titolo Prodotto', 'titolo', $catalog[0]->titolo); ?>
        <? echo form_input_nci('Sottotitolo', 'sottotitolo', $catalog[0]->sottotitolo); ?>
        <? echo form_textarea_nci('Testo Prodotto', 'testo', $catalog[0]->testo, 'class="ckeditor"'); ?>
        <? echo form_textarea_nci('Into Tecniche Prodotto', 'tecniche', $catalog[0]->tecniche, 'class="ckeditor required"'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="col_des_insert">
            <div class="modulo">
                <p><label for="mysubmit">Operazioni</label>
                    <? echo form_submit('mysubmit', 'Modifica Prodotto', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
                </p>
            </div>
            <div class="modulo">
                <p><label for="data">Data Prodotto</label>
                    <div class="row">
                        <div class="col-lg-4">
                    <select name="data_giorno" class="form-control">
                        <?php
                        for ($c = 1; $c <= 31; $c++) {
                            if ($c == $data_giorno)
                                $giorno_selected = "selected=\"selected\"";
                            else
                                $giorno_selected = "";
                            echo "<option value=\"$c\" $giorno_selected>$c</option>\n";
                        }
                        ?>
                    </select></div><div class="col-lg-4"><select name="data_mese" class="form-control">
                        <?php
                        for ($c = 1; $c <= 12; $c++) {
                            if ($c == $data_mese)
                                $mese_selected = "selected=\"selected\"";
                            else
                                $mese_selected = "";
                            echo "<option value=\"$c\" $mese_selected>$c</option>\n";
                        }
                        ?>
                    </select></div><div class="col-lg-4"><select name="data_anno" class="form-control">
                        <?php
                        for ($c = 2014; $c >= 1990; $c--) {
                            if ($c == $data_anno)
                                $anno_selected = "selected=\"selected\"";
                            else
                                $anno_selected = "";
                            echo "<option value=\"$c\" $anno_selected>$c</option>\n";
                        }
                        ?>
                    </select></div></div>
                </p>
            </div>
            <div class="modulo">
<?php echo form_input_nci('Link', 'titolo_rewrite', $catalog[0]->titolo_rewrite, '', 'Link della pagina'); ?>

            </div>
            <div class="modulo">
<?php echo form_input_nci('Link Correlato', 'link', $catalog[0]->link, '', 'Link da inserire al termine dell\'articolo'); ?>

            </div>
            <div class="modulo">
<?php echo form_input_nci('Prezzo (es. 45,00 non inserire simbolo €)', 'price', $catalog[0]->price); ?>
        </div>
            <div class="modulo">
                    <?php echo form_input_nci('Tags (separati da ,)', 'tags', $catalog[0]->tags); ?>
            </div>
            <div class="modulo">
                <p>

                    <label for="myfile">Immagine Prodotto</label>
<?php if ($catalog[0]->img != "") { ?>
                        <a href="<?= upload_url($catalog[0]->img) ?>" target="_blank"><img src="<?= upload_url($catalog[0]->img) ?>" width="100"></a><br>
                        <input type="checkbox" value="1" name="del_img" style="width:20px;"> Cancella Immagine
                <?php } ?>
                    <input type="file" name="userfile">
                </p>
            </div>
            <div class="modulo">
                <?php
                /* INSERISCO LE CATEGORIE NEL DROPBOX */
                $options = Array();
                $options[0] = "Nessuna Categoria";
                
                
                foreach ($catlist as $cat) {
                
                if ($cat->cat_padre == 0){
                
                $options["$cat->id_catalogcat"] = $cat->nome;
                
                
                foreach ($catlist as $cat2) {
                    
                     if ($cat2->cat_padre == $cat->id_catalogcat){
                         
                         $options["$cat2->id_catalogcat"] = "- ".$cat2->nome;
                     }
                }
                
                
                }
            }
                
                
                
                echo form_dropdown_nci('Categoria', 'id_cat', $options, $catalog[0]->id_cat);
                ?>
            </div>
            <div class="modulo">
                <?php
                /* INSERISCO LE CATEGORIE NEL DROPBOX */
                $options = Array();
                $options[0] = "Nessuna Gallery";
                foreach ($gallerylist as $gallery) {
                    $options["$gallery->id_gallery"] = $gallery->nome;
                }
                echo form_dropdown_nci('Gallery associata', 'id_gallery', $options, $catalog[0]->id_gallery);
                ?>
            </div>
        </div>    

    </div>

</div>




