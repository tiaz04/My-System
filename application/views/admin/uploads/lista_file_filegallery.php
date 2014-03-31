
<div class="col-md-9 col-sm-9">
    <div class="row">
        <table class="table">
            <thead>
            <th>Nome File</th>
            <th>Titolo e Descrizione</th>
            <th>Link al file</th>
            <th>Operazioni</th>
            </thead>
        <?php
        foreach ($lista_file as $file) {
            ?>
            <tr><td>
                    <?
                    if ($file->tipo_ref == "ext_file") {

                        echo ellipsize($file->link, 22, .5);
                    } else {

                        echo ellipsize($file->nome_file, 22, .5);
                    }
                    ?>
                </td>
                <td >
                    <b><?php echo ellipsize($file->titolo, 40, .8) ?></b><br>
                    <?php echo $file->descrizione ?>
                </td>
                <td>
                    <?php if ($file->tipo_ref == "ext_file") { ?>
                        <a href="<?php echo $file->link ?>" target="_blank">LINK FILE</a>
                    <? } else { ?>

                        <a href="<?php echo upload_url($file->nome_file) ?>" target="_blank">LINK FILE</a>
                    <? } ?>
                </td>

                <td>
                    <form method='post' action='' style="float:left; margin-right:4px; margin-left:3px;">
                        <?php
                        echo form_hidden('modify_sin', 'update_img');
                        echo form_hidden('mod[]', $file->id_file);
                        echo form_button('mysubmit', '<span class="glyphicon glyphicon-pencil"></span>','class="pull-right  btn btn-success btn-xs modbutton" type="submit"'); 
                        echo form_close();
                        ?><form method='post' action='' style="float:left;" onSubmit="return confirm('Confermi la rimozione del file?');">
                        <?php
                        echo form_hidden('delete', $file->id_file);
                        echo form_button('mysubmit', '<span class="glyphicon glyphicon-remove"></span>','class="pull-right  btn btn-danger btn-xs delbutton"'); 
                        echo form_close();
                        ?>
                            

                            



                            </td></tr>
                        <?php }
                        ?></table>
                        </div>
                        </div>