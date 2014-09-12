<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?>
<div class="container"><?php if ($this->session->get('auth')) { ?><h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('composeTitle'); ?></h1>
<form action="/baywa-nltool/<?php echo $language; ?>/mailobjects/update/" method="POST">
	<label><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('nameLabel'); ?></label><br>
	<input name="title" type="text" syle="width:400px;"><br><br>
<select name="templateobject">
<option value="0"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('selectTemplateLabel'); ?></option>
<?php foreach ($templateobjects as $templateobject) { ?>
<option value="<?php echo $templateobject->uid; ?>"><?php echo $templateobject->title; ?></option>
    
<?php } ?>
</select>
<input type="submit" value="<?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('ok'); ?>">
</form><?php } ?></div>
