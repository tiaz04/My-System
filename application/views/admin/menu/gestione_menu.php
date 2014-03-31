<h2>Gestione Menu &raquo; <?=$info_menu[0]->nome_menu?></h2>
<div id="messaggio"><?
    if ($risultato_inserimento == 1)
        echo "Operazione effettuata con successo";
    else if ($risultato_inserimento != "")
        echo "Errore nell'esecuzione dell'operazione"
        ?></div>
<div class="col_des_insert">
<div class="modulo">
<form name='myForm' id='myForm' method='post' action=''>
    <?
    echo form_hidden('ins_pagina','0');
    ?>
<p>
<label>Inserisci Pagina</label>

<?php
        /* INSERISCO LE CATEGORIE NEL DROPBOX */
        $options = Array();
        $options[0] = "";
        if ($lista_pag != "") {
            foreach ($lista_pag as $pag) {
                $options["$pag->id_pagina"] = $pag->nome;
            }
        }

        echo form_dropdown('pagina_ins', $options);
        ?> 

<button type="submit" name="btSubmit" id="btSubmit" class="buttonclass" style="margin-top:5px;">Inserisci</button>





</p>
</form>
</div>

    
</div>
<div class="col_cen">
    <div id="info"></div>
    <ul id="lista-moduli">
        <? foreach ($lista_elem as $item){ ?>
        <li id="listItem_<?php echo $item->id_rif; ?>"
                    class="modulo_view"><img src="<?= base_url('images/arrow.png') ?>"
                                         alt="move" width="16" height="16" class="handle" />
            <?=$item->nome?>
            <form method='post' action='' style="float: right;"
                              onSubmit="return confirm('Confermi la rimozione della pagina?');"><?php
        echo form_hidden('del_sin', $item->id_pagina);
        echo form_submit('mysubmit', '', 'class="delbutton"');
        echo form_close();
        ?>
            
        </li>
        
        
            <?
        }
        ?>
    
        
    </ul>
    
</div>

<script type="text/javascript">
                            // When the document is ready set up our sortable with it's inherant function(s)

                            $("#lista-moduli").sortable({
                                handle: '.handle',
                                update: function() {
                                    var order = $('#lista-moduli').sortable('toArray');
                                    $("#info").load("<?php echo base_url('admin/menu/aggiorno_pos') ?>", {'ordine': order});
                                }
                            });

                        </script>


