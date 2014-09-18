<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?>
<div class="container">
<div id="fileTollBar"><div class="glyphicon glyphicon-floppy-save" id="mailobjectSave" data-controller="mailobject" data-action="create"><span class="itemLabel"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('save'); ?></span></div></div><?php if ($this->session->get('auth')) { ?><h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('composeTitle'); ?></h1>
<form action="/baywa-nltool/<?php echo $language; ?>/mailobjects/create/" method="POST">
	<label><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('nameLabel'); ?></label><br>
	<input name="title" type="text" syle="width:400px;"><br><br>

	<ul id="templateCarousel">
		
<?php foreach ($templateobjects as $templateobject) { ?>
<li data-uid="<?php echo $templateobject->uid; ?>"><h3><?php echo $templateobject->title; ?></h3><br>
	<img src="<?php echo $templateobjectsthumbs[$templateobject->uid]; ?>">
	
</li>
    
<?php } ?>
	</ul>
	<div class="clearfix"></div>
<input type="hidden" name="templateobject" value="0">
<input type="submit" value="<?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('ok'); ?>">
</form><?php } ?></div>
