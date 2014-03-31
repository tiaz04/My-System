<script>
    $(document).ready(function() {
        $("#tobevalidate").validate();
    });
</script>
<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/news') ?>">News</a></li>
    <li class="active">Aggiungi News</li>
</ol>
<h2>Inserimento News</h2>
<?
$attributes = array('id' => 'tobevalidate');

echo form_open_multipart('admin/news/aggiungidb', $attributes);

$data_giorno = date('j', mktime());
$data_mese = date('n', mktime());
$data_anno = date('Y', mktime());
?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Titolo News', 'titolo', '', 'class="required form-control"'); ?>
        <? echo form_input_nci('Sottotitolo', 'sottotitolo'); ?>
        <? echo form_textarea_nci('Testo News', 'testo', '', 'class="ckeditor required"'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="modulo">
            <p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica News', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
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
                </select></div>
            </div>
            </p>
        </div>
        <div class="modulo">
            <?php echo form_input_nci('Link Correlato', 'link', '', '', 'Link da inserire al termine dell\'articolo'); ?>

        </div>
        <div class="modulo">
<?php echo form_input_nci('Tags (separati da ,)', 'tags'); ?>
        </div>
        <div class="modulo">
            <p><label for="myfile">Immagine News</label><input type="file" class="form-control" name="userfile">
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
            echo form_dropdown_nci('Categoria', 'id_cat', $options, '0');
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
            echo form_dropdown_nci('Gallery associata', 'id_gallery', $options, '0');
            ?>
        </div>
    </div>
</div>



