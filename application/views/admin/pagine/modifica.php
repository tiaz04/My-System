<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/pagine') ?>">Pagine</a></li>
    <li class="active">Modifica Pagina</li>
</ol>
<h2>Modifica Pagina</h2>
<div id="messaggio"><?
    if ($risultato_inserimento == 1)
        echo "<div class=\"alert alert-success alert-dismissable\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>            
Operazione effettuata con successo</div>";
    else if ($risultato_inserimento != "")
        echo "<div class=\"alert alert-danger alert-dismissable\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Errore nell'esecuzione dell'operazione</div>"
        ?></div>
<div class="row">
    <div class="col-sm-9">
        <div class="modulo_insert"><h3>Inserisci nuovo Modulo</h3> <script>
            $(document).ready(function() {
                $("#tobevalidate").validate();
            });
            </script> <?php
            $attributes = array('id' => 'tobevalidate');

            echo form_open_multipart('admin/pagine/modifica/' . $pagina[0]->id_pagina, $attributes);

            $options = array(
                '' => '',
                'testo' => 'Testo',
                'gallery' => 'Galleria di Immagini',
                'immagine' => 'Immagine',
                'video' => 'Modulo Video',
                'file' => 'File',
            );

            $js = 'id="tipo_modulo" onChange="carica_contenuto_modulo();"';

            echo form_dropdown_nci('Tipologia Modulo', 'tipologia_contenuto', $options, '', $js);
            ?>
            <div id="moduli">
                <div id="file_field" style="display:none;">
                    <h2>Seleziona File da Filegallery</h2>
                    <div id="image_filegallery">
                        <div class="menu_ajaxfilegallery">
                            <ul>
                                <?php
                                $options = Array();
                                foreach ($filegallerylist as $gallery) {
                                    echo "<li rel=\"" . $gallery->id_filegallery . "\">" . $gallery->nome . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="ajaxfilegallery" class="filegallery"></div>
                    </div>
                    <input type="hidden" value="" name="filegallery" id="ajaxfileid">
                </div>
                <div id="testo_field" style="display: none;">
                    <h2>Inserisci il testo</h2>
                    <? echo form_textarea_nci('Testo Modulo', 'contenuto', '', 'class="ckeditor required"'); ?>
                </div>
                <div id="gallery_field" style="display: none;">
                    <h2>Seleziona la gallery</h2>
                    <?php
                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                    $options = Array();
                    foreach ($gallerylist as $gallery) {
                        $options["$gallery->id_gallery"] = $gallery->nome;
                    }
                    echo form_dropdown_nci('Gallery associata', 'id_gallery', $options, '0');
                    ?>
                    <?php echo form_checkbox('solo_link', 'solo_link', FALSE, "", "Inserire solo link di riferimento"); ?>
                </div>
                <div id="video_field" style="display: none;">

                    <h2>Seleziona la Videogallery</h2>
                    <?php
                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                    $options = Array();
                    foreach ($videolist as $video) {
                        $options["$video->id_videogallery"] = $video->nome;
                    }
                    echo form_dropdown_nci('Videogallery associata', 'id_videogallery', $options, '0');
                    ?>
                    <?php echo form_checkbox('solo_link', 'solo_link', FALSE, '', 'Inserire solo link di riferimento'); ?>
                </div>
                <div id="immagine_field" style="display: none;">

                    <h2>Seleziona Immagine da Gallery</h2>
                    <div id="image_gallery">
                        <div class="row">
                            <div class="menu_ajaxgallery col-sm-3">
                                <div class="list-group">


                                    <?php
                                    $options = Array();
                                    foreach ($gallerylist as $gallery) {
                                        echo "<a href=\"#\" class=\"list-group-item\" rel=\"" . $gallery->id_gallery . "\">" . $gallery->nome . "</a>";
                                    }
                                    ?>

                                </div>
                            </div>
                            <div id="ajaxgallery" class="gallery col-sm-9"></div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="imagegallery" id="ajaximageid">
                </div>
                <? echo form_submit('mysubmit', 'Inserisci Modulo', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        <legend>Moduli</legend>
        <ul id="lista-moduli">


            <?php
            /** STAMPO I MODULI ATTUALMENTE PRESENTI */
            if (isset($modulilist)) {

                foreach ($modulilist as $modulo) {



                    if ($modulo->tipologia_contenuto == 'testo') {
                        $tipo = 'Testo';
                        $titolo = '';
                        $contenuto = $modulo->contenuto;
                    }
                    if ($modulo->tipologia_contenuto == 'gallery') {
                        $tipo = 'Gallery';
                        $titolo = $modulo->arrcont[0]->nome;
                        $contenuto = "";
                        foreach ($modulo->arrcont['lista_file'] as $numero) {
                            $contenuto.='<img src="' . upload_url($numero->nome_file2) . '" style="width:60px; margin-right:3px;">';
                        }
                    }


                    if ($modulo->tipologia_contenuto == 'video') {
                        $tipo = 'Video';
                        $titolo = $modulo->arrcont[0]->nome;
                        $contenuto = "";
                        foreach ($modulo->arrcont['lista_file'] as $numero) {
                            if ($numero->tipo_ref == 'video')
                                $contenuto.="<div style=\"border:1px solid #FFF; padding:5px; margin:5px;\"><b>$numero->titolo</b><br>$numero->nome_file </div>";
                            if ($numero->tipo_ref == 'video_youtube')
                                $contenuto.="<div style=\"border:1px solid #FFF; padding:5px; margin:5px;\"><b>$numero->titolo</b><br>$numero->link <br/></div>";
                        }
                    }
                    if ($modulo->tipologia_contenuto == 'immagine') {

                        $tipo = "Immagine";
                        $titolo = "";
                        $contenuto = "<img class=\"module_img\" src=\"";
                        $contenuto.=upload_url($modulo->arrcont[0]->nome_file);
                        $contenuto.="\">";
                    }

                    if ($modulo->tipologia_contenuto == 'file') {



                        $tipo = "File";
                        $titolo = "";
                        $contenuto = "<a href=\"";
                        $contenuto.=upload_url($modulo->arrcont[0]->nome_file);
                        $contenuto.="\"><strong>Titolo: " . $modulo->arrcont[0]->titolo . "</strong><br/>Descrizione: " . $modulo->arrcont[0]->descrizione . "<br/>Nome File: " . $modulo->arrcont[0]->nome_file . "" . $modulo->arrcont[0]->link . "</a>";
                    }
                    ?>

                    <li id="listItem_<?php echo $modulo->id_paginemodulo; ?>"
                        class="modulo_view"><img src="<?= base_url('images/arrow.png') ?>"
                                             alt="move" width="16" height="16" class="handle" />
                        <? if ($titolo!=""){ ?><h3 class="modulo_title"><?php echo $titolo ?></h3><? } ?>
        <?php echo $contenuto ?>
                        <div class="modulo_tipo"><b>TIPOLOGIA MODULO:</b> <?php echo $tipo; ?>

                            <form method='post' action='' style="float: right;"
                                  onSubmit="return confirm('Confermi la rimozione del modulo?');"><?php
        echo form_hidden('del_sin', $modulo->id_paginemodulo);
        echo"<button type=\"submit\" class=\"delbutton btn btn-danger btn-xs\">
  <span class=\"glyphicon glyphicon-remove\"></span>
</button>";

        echo form_close();
        ?>
                                <form method='post' action=''
                                      style="float: right; margin-right: 4px; margin-left: 3px;"><?php
                              echo form_hidden('modify_sin', $modulo->id_paginemodulo);
                              echo"<button type=\"submit\" class=\"modbutton btn btn-info btn-xs\">
  <span class=\"glyphicon glyphicon-edit\"></span>
</button>";

                              echo form_close();
        ?>

                                    </div>
                                    </li>
        <?php
    }
}
?>

                            </div>
                            <div class="col-sm-3">
                                <div class="modulo"><?
                            echo form_open_multipart('admin/pagine/modificadb/' . $pagina[0]->id_pagina);
?>
                                    <h4>Modifica Impostazioni Pagina</h4> 
                                    <p><b>Nome Pagina</b> <input
                                            type="text" class="form-control" name="nome" value="<?= $pagina[0]->nome ?>"></p>
                                    <p><b>Nome Link</b> <input type="text" class="form-control" name="rewrite"
                                                               value="<?= $pagina[0]->nome_rewrite ?>"></p>
                                    <p><b>Titolo</b> <input type="text" class="form-control" name="titolo"
                                                            value="<?= $pagina[0]->titolo ?>"></p>
                                    <p><b>Descrizione</b> <input type="text" class="form-control" name="descrizione"
                                                                 value="<?= $pagina[0]->descrizione ?>"></p>

<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array();
$options[0] = "Nessuna Pagina";
if ($lista_pag != "") {
    foreach ($lista_pag as $pag) {
        $options["$pag->id_pagina"] = $pag->nome;
    }
}
echo form_dropdown_nci('Pagina Padre', 'pagina_padre', $options, $pagina[0]->pagina_padre);
?> 
                                    <?php
                                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                                    $options = Array();
                                    $options[0] = "No";
                                    $options[1] = "Si";
                                    echo form_dropdown_nci('Nascondi Link', 'hidelink', $options, $pagina[0]->hidelink);
                                    ?> 
                                    <?php
                                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                                    $options = Array();
                                    $options[0] = "No";
                                    $options[1] = "Si";
                                    echo form_dropdown_nci('Nascondi In Menu', 'hideInMenu', $options, $pagina[0]->hideInMenu);
                                    ?> 
                                    <?php
                                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                                    $options = Array();
                                    foreach ($templates as $temp) {
                                        $options["$temp->id"] = $temp->nome;
                                    }
                                    echo form_dropdown_nci('Template', 'template', $options, $pagina[0]->template);
                                    ?> 
                                    <?php
                                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                                    $options = Array();
                                    $options[0] = "Nessuna Categoria";
                                    foreach ($lista_cat as $cat) {
                                        $options["$cat->id_paginecat"] = $cat->nome;
                                    }
                                    echo form_dropdown_nci('Categoria', 'id_cat', $options, $pagina[0]->id_cat);
                                    ?> <?php
                                    /* INSERISCO LE CATEGORIE NEL DROPBOX */
                                    $options = Array();
                                    $options[0] = "Nessun Header";
                                    foreach ($headerimglist as $header) {
                                        $options["$header->nome_gallery"] = $header->nome_gallery;
                                    }
                                    echo form_dropdown_nci('Header Associato', 'header_img', $options, $pagina[0]->header_img);
                                    ?>
                                    <p><b>Ordine</b>
                                        <input type="text" class="form-control" name="order"
                                               value="<?= $pagina[0]->order ?>">
                                    </p><p>
                                        <b>Link Diretto</b>
                                        <input type="text" class="form-control" name="directLink"
                                               value="<?= $pagina[0]->directLink ?>">
                                    </p><p>
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array();
$options[0] = "Nessuna Cat.FAQ";
foreach ($catfaq_list as $catfaq) {
    $options["$catfaq->id_faqcat"] = $catfaq->nome;
}
echo form_dropdown_nci('Categoria FAQ', 'id_faqcat', $options, $pagina[0]->id_faqcat);
?></p>
                                        <? echo form_submit('mysubmit', 'Modifica Pagina', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>

                                    </p>
                                </div>
                                        <?php echo form_close(); ?></div>

                            </div>
                            <div id="info"></div>
                            <script type="text/javascript">
            function carica_contenuto_modulo() {
                valore = $('#tipo_modulo').val();

                var item1 = $('div').not(":hidden");
                $('#moduli').find(item1).hide();
                $('#' + valore + '_field').show();

            }
                            </script>
                            <script type="text/javascript">
                                // When the document is ready set up our sortable with it's inherant function(s)

                                $("#lista-moduli").sortable({
                                    handle: '.handle',
                                    update: function() {
                                        var order = $('#lista-moduli').sortable('toArray');
                                        $("#info").load("<?php echo base_url('admin/pagine/aggiorno_pos') ?>", {'ordine': order});
                                    }
                                });

                            </script>
