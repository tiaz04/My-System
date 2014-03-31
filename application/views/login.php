<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
	<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<title><?php echo $info['nome_sito'];?></title>
		<link href="<?=base_url('css/admin.css')?>" rel="stylesheet" type="text/css">
		<link type="text/css" rel="stylesheet" href="<?=base_url('uploadify/uploadify.css')?>" />
	<script type="text/javascript" src="<?=base_url('js/jquery.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/jquery-ui-1.8.16.custom.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/jquery.scrollTo-1.4.2-min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('libraries/uploadify/jquery.uploadify.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('libraries/uploadify/flash_detect.1.0.4.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/uploadifyscript.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('libraries/ckeditor/ckeditor.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('libraries/ckeditor/adapters/jquery.js')?>"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('libraries/shadowbox/shadowbox.css')?>">
	<script type="text/javascript" src="<?=base_url('libraries/shadowbox/shadowbox.js')?>"></script>
	<script type="text/javascript">
	Shadowbox.init();
	</script>
	</head>
	<body>
	<div style="width:400px; margin:0 auto; margin-top:100px;">
<h2>Login Gestione <?php echo $info['nome_sito'];?></h2>
                <?php echo form_open('login/process_login') . "\n"; ?>
                    <?php echo form_fieldset('Login') . "\n"; ?>

                        <?php echo $this->session->flashdata('message'); ?>
                        
                        <p><label for="username">Username: </label><?php echo form_input($username); ?></p>
                        <p><label for="password">Password: </label><?php echo form_password($password); ?></p>
                        <p><?php echo form_submit('login', 'Login'); ?></p>
                    <?php echo form_fieldset_close(); ?>
                <?php echo form_close(); ?>
                
                </div>
	</body>
	</html>