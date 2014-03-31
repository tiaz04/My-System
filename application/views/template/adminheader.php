<?
$userpermission = explode("|", $info['userinfo']['permission']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $info['nome_sito']; ?></title>
        <script>
            var baseAddress = "<?php echo $info['indirizzo_sito']; ?>";
            var uploadAddress = "<?php echo $info['indirizzo_upload']; ?>";

        </script>
        <!--<link href="<?php echo $info['indirizzo_sito']; ?>css/admin.css" rel="stylesheet" type="text/css">-->
        <link href="<?php echo $info['indirizzo_sito']; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo $info['indirizzo_sito']; ?>css/adminboot.css" rel="stylesheet" media="screen">
        <link type="text/css" rel="stylesheet" href="<?php echo $info['indirizzo_sito']; ?>libraries/uploadify/uploadify.css" />
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/additional-methods.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>libraries/uploadify/jquery.uploadify.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>libraries/uploadify/flash_detect.1.0.4.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/uploadifyscript.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>libraries/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $info['indirizzo_sito']; ?>libraries/shadowbox/shadowbox.css">
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>libraries/shadowbox/shadowbox.js"></script>
        <script type="text/javascript" src="<?= base_url('js/ajaxgallery.js') ?>"></script>
        <script type="text/javascript">
            Shadowbox.init();
        </script>
        <script src="<?php echo $info['indirizzo_sito']; ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $info['indirizzo_sito']; ?>js/cms.js"></script>



    </head>
    <body>
          <nav class="navbar navbar-inverse navbar-default navbar-fixed-top headernav" role="navigation">
              
              <a class="navbar-brand" href="#"><?= $info['nome_sito'] ?></a>
            
              <p class="navbar-text pull-right"> Ciao <?= $info['userinfo']['username'] ?> | <?= $info['version'] ?> | <a class="btn btn-xs btn-default" href="<?= base_url('login/logout') ?>"><span class="glyphicon glyphicon-user"></span> Log Out</a></p>

        </nav>
        
        <div class="container-full">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <div class="panel-group adminMenu" id="accordion">

                        <? if ((in_array("news", $userpermission)) || ($userpermission[0] == "all")) { ?>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#news">
                                            News <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="news" class="panel-collapse collapse <?=$this->router->class=="news" ? "in" : "" ?>">
                                    <div class="panel-body">


                                        <ul class="list-group">
                                            <a class="list-group-item" href="<?= base_url('admin/news') ?>">Lista News</a>
                                            <a class="list-group-item" href="<?= base_url('admin/news/aggiungi') ?>">Aggiungi News</a>
                                            <a class="list-group-item" href="<?= base_url('admin/news/listacat') ?>">Lista Categorie</a>
                                            <a class="list-group-item" href="<?= base_url('admin/news/aggiungicat') ?>">Aggiungi Categoria</a>
                                            <a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/news') ?>">Traduzioni News</a>
                                        </ul>  

                                    </div>
                                </div>
                            </div>




                        <? } ?>      
                        
                        <? if ((in_array("catalog", $userpermission)) || ($userpermission[0] == "all")) { ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#catalog">
                                            Catalogo <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="catalog" class="panel-collapse collapse <?=$this->router->class=="catalog" ? "in" : "" ?>">
                                    <div class="panel-body">

                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/catalog') ?>">Lista Prodotti</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/catalog/aggiungi') ?>">Aggiungi Prodotto</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/catalog/listacat') ?>">Lista Categorie</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/catalog/aggiungicat') ?>">Aggiungi Categoria</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/catalog') ?>">Traduzioni Catalogo</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <? } ?>


                        <? if ((in_array("press", $userpermission)) || ($userpermission[0] == "all")) { ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#press">
                                            Press <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="press" class="panel-collapse collapse <?=$this->router->class=="press" ? "in" : "" ?>">
                                    <div class="panel-body">

                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/press') ?>">Lista Press</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/press/aggiungi') ?>">Aggiungi Press</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/press/listacat') ?>">Lista Categorie</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/press/aggiungicat') ?>">Aggiungi Categoria</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/press') ?>">Traduzioni Press</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <? } ?>

                        <? if ((in_array("blog", $userpermission)) || ($userpermission[0] == "all")) { ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#blog">
                                            Blog <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="blog" class="panel-collapse collapse <?=$this->router->class=="blog" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/blog') ?>">Lista Blog</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/blog/aggiungi') ?>">Aggiungi Blog</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/blog/listacat') ?>">Lista Categorie</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/blog/aggiungicat') ?>">Aggiungi Categoria</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/blog') ?>">Traduzioni Blog</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>


                        <? if ((in_array("faq", $userpermission)) || ($userpermission[0] == "all")) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#faq">
                                            Faq <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="faq" class="panel-collapse collapse <?=$this->router->class=="faq" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/faq') ?>">Lista D&R</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/faq/aggiungi') ?>">Aggiungi D&R</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/faq/listacat') ?>">Lista Categorie</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/faq/aggiungicat') ?>">Aggiungi Categoria</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/faq') ?>">Traduzioni D&R</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/catfaq') ?>">Traduzioni Cat. D&R</a></li>
                                        </ul></div>
                                </div>
                            </div>

                        <? } ?>
                        <? if ((in_array("pacchetti", $userpermission)) || ($userpermission[0] == "all")) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pacchetti">
                                            Pacchetti <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="pacchetti" class="panel-collapse collapse <?=$this->router->class=="pacchetti" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/pacchetti') ?>">Lista Pacchetti</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/pacchetti/aggiungi') ?>">Aggiungi Pacchetto</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/pacchetti') ?>">Traduzioni Pacchetti</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                        <? if ((in_array("eventi", $userpermission)) || ($userpermission[0] == "all")) { ?>    
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#eventi">
                                            Eventi <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="eventi" class="panel-collapse collapse <?=$this->router->class=="eventi" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/eventi') ?>">Lista Eventi</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/eventi/aggiungi') ?>">Aggiungi Eventi</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/eventi') ?>">Traduzioni Eventi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>   
                        <? if ((in_array("pagine", $userpermission)) || ($userpermission[0] == "all")) { ?>    
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#pagine">
                                            Pagine <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="pagine" class="panel-collapse collapse <?=$this->router->class=="pagine" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/pagine') ?>">Lista Pagine</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/pagine/aggiungi') ?>">Aggiungi Pagina</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/pagine/listacat') ?>">Lista Categorie</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/pagine/aggiungicat') ?>">Aggiungi Categoria</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/pagine') ?>">Traduzioni Pagine</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("tariffe", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#tariffe">
                                            Tariffe <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="tariffe" class="panel-collapse collapse <?=$this->router->class=="tariffe" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/tariffe/aggiungi_tariffa') ?>">Aggiungi Tariffe</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/tariffe/') ?>">Gestione Tariffe</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/tariffe') ?>">Traduzioni Tariffe</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("gallery", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#menugallery">
                                            Gallery <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="menugallery" class="panel-collapse collapse <?=$this->router->class=="gallery" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/gallery') ?>">Lista Gallery</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/gallery/aggiungi') ?>">Aggiungi Gallery</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("video", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#menuvideo">
                                            Video Gallery <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="menuvideo" class="panel-collapse collapse <?=$this->router->class=="video" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/video') ?>">Lista Videogallery</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/video/aggiungi') ?>">Aggiungi Videogallery</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("filegallery", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#filegallery">
                                            Gestione File <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="filegallery" class="panel-collapse collapse <?=$this->router->class=="filegallery" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/filegallery') ?>">Lista Cartelle</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/filegallery/aggiungi') ?>">Aggiungi Cartella</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/filegallery') ?>">Traduzioni File</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("glossario", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#glossario">
                                            Glossario <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="glossario" class="panel-collapse collapse <?=$this->router->class=="glossario" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/glossario') ?>">Lista Glossario</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/glossario/aggiungi') ?>">Aggiungi Elemento</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/glossario') ?>">Traduzioni Glossario</a></li>
                                        </ul></div>
                                </div>
                            </div>
                        <? } ?>  
                        <? if ((in_array("menu", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#menu">
                                            Menu <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="menu" class="panel-collapse collapse <?=$this->router->class=="menu" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/menu') ?>">Lista Menu</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/menu/aggiungi') ?>">Aggiungi Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?> 
                        <? if ((in_array("traduzioni", $userpermission)) || ($userpermission[0] == "all")) { ?> 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#traduzioni">
                                            Traduzioni <b class="caret"></b>
                                        </a>
                                    </h4>
                                </div>
                                <div id="traduzioni" class="panel-collapse collapse <?=$this->router->class=="traduzioni" ? "in" : "" ?>">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/pagine') ?>">Traduzioni Pagine</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/news') ?>">Traduzioni News</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/blog') ?>">Traduzioni Blog</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/press') ?>">Traduzioni Press</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/faq') ?>">Traduzioni D&R</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/catfaq') ?>">Traduzioni Cat. D&R</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/glossario') ?>">Traduzioni Glossario</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/tariffe') ?>">Traduzioni Tariffe</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/pacchetti') ?>">Traduzioni Pacchetti</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/eventi') ?>">Traduzioni Eventi</a></li>
                                            <li><a class="list-group-item" href="<?= base_url('admin/traduzioni/lista/filegallery') ?>">Traduzioni File</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <? } ?> 


                    </div>
                </div>
                <div class="col-md-10 col-sm-10">
                    
                    
                









      


        


