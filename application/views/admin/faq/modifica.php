<h2>Modifica Domanda & Risposta</h2>
<?
echo form_open_multipart('admin/faq/modificadb/'.$faq[0]->id_faq);

$data_giorno=date('j',$faq[0]->data);
$data_mese=date('n',$faq[0]->data);
$data_anno=date('Y',$faq[0]->data);

?>
<div class="row">
    <div class="col-sm-9">
<? echo form_textarea_nci('Domanda','domanda',$faq[0]->domanda,'class="ckeditor"'); ?>
<? echo form_textarea_nci('Risposta','risposta',$faq[0]->risposta,'class="ckeditor"'); ?>
</div>
<div class="col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>    
</p>
</div>
  <div class="modulo">
                <p><label for="data">Data D&R</label>
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
<?php echo form_input_nci('Link','domanda_rewrite',$faq[0]->domanda_rewrite,'','Link della pagina');?>

</div>
<div class="modulo">
<?php echo form_input_nci('Link Correlato','link',$faq[0]->link,'','Link da inserire al termine dell\'articolo');?>

</div>
    <div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Categoria";
foreach ($catlist as $cat){
		$options["$cat->id_faqcat"]=$cat->nome;
}
echo form_dropdown_nci('Categoria','id_cat', $options, $faq[0]->id_cat);?>
</div>
<div class="modulo">
<?php echo form_input_nci('Tags (separati da ,)','tags',$faq[0]->tags);?>
</div>

<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Gallery";
foreach ($gallerylist as $gallery){
		$options["$gallery->id_gallery"]=$gallery->nome;
}
echo form_dropdown_nci('Gallery associata','id_gallery', $options, $faq[0]->id_gallery);?>
</div>
</div>

</div>