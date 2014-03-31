<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/press') ?>">Press</a></li>
    <li class="active">Modifica Press</li>
</ol>
<h2>Modifica Press</h2>
<?
echo form_open_multipart('admin/press/modificadb/' . $press[0]->id_press);

$data_giorno = date('j', $press[0]->data);
$data_mese = date('n', $press[0]->data);
$data_anno = date('Y', $press[0]->data);
?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Titolo Press', 'titolo', $press[0]->titolo); ?>
        <? echo form_input_nci('Sottotitolo', 'sottotitolo', $press[0]->sottotitolo); ?>
        <? echo form_textarea_nci('Testo Press', 'testo', $press[0]->testo, 'class="ckeditor"'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="col_des_insert">
            <div class="modulo">
                <p><label for="mysubmit">Operazioni</label>
                    <? echo form_submit('mysubmit', 'Modifica Press', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
                </p>
            </div>
            <div class="modulo">
                <p><label for="data">Data Press</label>
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
<?php echo form_input_nci('Link', 'titolo_rewrite', $press[0]->titolo_rewrite, '', 'Link della pagina'); ?>

            </div>
            <div class="modulo">
<?php echo form_input_nci('Link Correlato', 'link', $press[0]->link, '', 'Link da inserire al termine dell\'articolo'); ?>

            </div>
            <div class="modulo">
                    <?php echo form_input_nci('Tags (separati da ,)', 'tags', $press[0]->tags); ?>
            </div>
            <div class="modulo">
<p>

<label for="myfile">File Press</label><br>
<?php if ($press[0]->img!=""){ ?>
<a href="<?=upload_url($press[0]->img)?>" target="_blank"><?=$press[0]->img?></a><br>
<input type="checkbox"  value="1" name="del_img" style="width:20px;"> Cancella File
<?php }?>
<input type="file" class="form-control" name="userfile">
</p>
</div>
            <div class="modulo">
                <?php
                /* INSERISCO LE CATEGORIE NEL DROPBOX */
                $options = Array();
                $options[0] = "Nessuna Categoria";
                foreach ($catlist as $cat) {
                    $options["$cat->id_presscat"] = $cat->nome;
                }
                echo form_dropdown_nci('Categoria', 'id_cat', $options, $press[0]->id_cat);
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
                echo form_dropdown_nci('Gallery associata', 'id_gallery', $options, $press[0]->id_gallery);
                ?>
            </div>
        </div>    

    </div>

</div>







