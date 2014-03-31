<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/gallery') ?>">Gallery</a></li>
    <li class="active">Gestione Immagini</li>
</ol>
<h2>Gestione Immagini / <?=$info_gallery[0]->nome?></h2>
<div id="messaggio"><?

if (isset($modifiche_res)){
if ($modifiche_res==1)
echo "<div class=\"alert alert-dismissable alert-success\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Immagini modificate con successo
</div>";
else
    echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Errore nella modifca dell'immagine
</div>";
} ?>
<?
if (isset($cancella_res)){
if ($cancella_res==1)
echo "<div class=\"alert alert-dismissable alert-success\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Immagine cancellata con successo
</div>";
else
echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Errore nella cancellazione dell'immagine
</div>";
}
?>
</div>


