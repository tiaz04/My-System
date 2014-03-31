<script>
    $(document).ready(function() {
        $("#tobevalidate").validate();
    });
</script>
<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/pacchetti') ?>">Pacchetti</a></li>
    <li class="active">Aggiungi Pacchetto</li>
</ol>
<h2>Inserimento Pacchetti</h2>
<?php
$attributes = array('id' => 'tobevalidate');
echo form_open_multipart('admin/pacchetti/aggiungidb', $attributes);
?>

<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Nome Pacchetto', 'nome', '', 'class="required form-control"'); ?>
        <? echo form_textarea_nci('Descrizione', 'descrizione', '', 'class="ckeditor"'); ?>
        <h3>Stagionalit&agrave; / Periodi</h3>
        <table width="100%" class="tabella table table-bordered">
            <tbody>
                <tr>
                    <td width="33%" rowspan="2">Tipo Stagione 1</td>
                    <td width="33%">Periodo 1 - dal (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s1periodo1_dal"></td><td width="33%">Al (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s1periodo1_al">
                    </td>
                </tr>
                <tr>
                    <td>Periodo 2 - dal (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s1periodo2_dal"></td><td>Al (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s1periodo2_al">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Tipo Stagione 2</td>
                    <td>Periodo 1 - dal (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s2periodo1_dal"></td><td>Al (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s2periodo1_al">
                    </td>
                </tr>
                <tr>
                    <td>Periodo 2 - dal (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s2periodo2_dal"></td><td>Al (f.to GG/MM/AAAA)
                        <input type="text" class="form-control"  name="s2periodo2_al">
                    </td>
                </tr>
            </tbody>
        </table>
        <h3>Tipologie di camere/prezzi</h3>
        <?php
        $tmpl = array('table_open' => "$info[open_tabella]");

        $this->table->set_template($tmpl);

        $this->table->set_heading('Tipo Camera', 'Attivo', 'Prezzo Stagione 1', 'Prezzo Stagione 2');


        foreach ($info['pacchetti_camere'] as $key => $camere) {



            $this->table->add_row($camere, "<label class=\"radio-inline\"><input type=\"radio\" value=\"1\" name=\"" . $key . "-active\" style=\"width:20px;\"> Si </label><label class=\"radio-inline\"><input type=\"radio\" value=\"0\" name=\"" . $key . "-active\" style=\"width:20px;\"> No</label>", "<input type=\"text\" class=\"form-control\" name=\"" . $key . "-s1\">", "<input type=\"text\" class=\"form-control\" name=\"" . $key . "-s2\">");
        }

        echo $this->table->generate();
        ?>

        <br><br>

    </div>
    <div class="col-md-3 col-sm-3">
        <div class="modulo">
            <p>
                <label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Inserisci Pacchetto', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
            </p>
        </div>
        <div class="modulo">
<?php echo form_input_nci('Anno Listino', 'anno', '', '', ''); ?>
        </div>
        <div class="modulo">
            <p><label for="myfile">Immagine Pacchetto</label><input type="file" name="userfile">
            </p>
        </div>
        <div class="modulo">
            <p>
                <label for="attivo">Attivo</label>
                <select name="attivo">
                    <option value="0">No</option>
                    <option value="1" selected="selected">Si</option>
                </select>
            </p>
        </div>
        <div class="modulo">
            <p>
                <label for="strategia">Strategia di pubblicazione</label>
                <input type="radio" name="strategia" value="switch" style="width:20px;"> Switch<br>
                <input type="radio" name="strategia" value="periodo" style="width:20px;"> A periodo<br>
                Visibile dal (f.to GG/MM/AAAA) <input type="text" class="form-control"  name="visibile_dal">
                Al (f.to GG/MM/AAAA) <input type="text" class="form-control"  name="visibile_al">			
            </p>
        </div>  
    </div>
</div>


