<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/faq') ?>">Domande & Risposte</a></li>
    <li class="active">Aggiungi Domande & Risposte</li>
</ol>

  

<? if ($risultato_inserimento==1){
    ?>
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Elemento</strong> inserito con successo
</div>
<?
}else{
  ?>  
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Errore</strong> nell'inserimento dell'elemento
</div>
    <?
} ?>