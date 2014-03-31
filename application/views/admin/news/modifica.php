<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/news') ?>">News</a></li>
    <li class="active">Modifica News</li>
</ol>
<h2>Modifica News</h2>
<?
echo form_open_multipart('admin/news/modificadb/' . $news[0]->id_news);

$data_giorno = date('j', $news[0]->data);
$data_mese = date('n', $news[0]->data);
$data_anno = date('Y', $news[0]->data);
?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Titolo News', 'titolo', $news[0]->titolo); ?>
        <? echo form_input_nci('Sottotitolo', 'sottotitolo', $news[0]->sottotitolo); ?>
        <? echo form_textarea_nci('Testo News', 'testo', $news[0]->testo, 'class="ckeditor"'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="col_des_insert">
            <div class="modulo">
                <p><label for="mysubmit">Operazioni</label>
                    <? echo form_submit('mysubmit', 'Modifica News', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
                </p>
            </div>
            <div class="modulo">
                <p><label for="data">Data News</label>
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
<?php echo form_input_nci('Link', 'titolo_rewrite', $news[0]->titolo_rewrite, '', 'Link della pagina'); ?>

            </div>
            <div class="modulo">
<?php echo form_input_nci('Link Correlato', 'link', $news[0]->link, '', 'Link da inserire al termine dell\'articolo'); ?>

            </div>
            <div class="modulo">
                    <?php echo form_input_nci('Tags (separati da ,)', 'tags', $news[0]->tags); ?>
            </div>
            <div class="modulo">
                <p>

                    <label for="myfile">Immagine News</label>
<?php if ($news[0]->img != "") { ?>
                        <a href="<?= upload_url($news[0]->img) ?>" target="_blank"><img src="<?= upload_url($news[0]->img) ?>" width="100"></a><br>
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
                    $options["$cat->id_newscat"] = $cat->nome;
                }
                echo form_dropdown_nci('Categoria', 'id_cat', $options, $news[0]->id_cat);
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
                echo form_dropdown_nci('Gallery associata', 'id_gallery', $options, $news[0]->id_gallery);
                ?>
            </div>
        </div>    

    </div>

</div>




