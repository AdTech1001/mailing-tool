<?php use Phalcon\Tag as Tag ?>

<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?><?php if ($this->session->get('auth')) { ?><div class="container">
<div id="fileToolBar">
	<div class="glyphicon glyphicon-edit" id="mailobjectEditMode" data-controller="mailobject" data-action="update"><span class="itemLabel"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('edit'); ?></span>
	</div>
	<div class="glyphicon glyphicon-floppy-save" id="mailobjectUpdate" data-controller="mailobject" data-action="update"><span class="itemLabel"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('save'); ?></span>
	</div>
</div>		
	<div id="tooltipOverlay" class="hidden">
		<form id="contentElements">
			<label>tr('contentTypeLabel')</label><br>
			<select name="contentType">
				<option value="0">tr('plaintext')</option>
				<option value="1">tr('rte')</option>
				<option value="2">tr('devider')</option>
				<option value="3">tr('image')</option>
				<option value="4">tr('custom')</option>
				<option value="5">tr('dynamic')</option>
			</select><br><br>
			<div class="hidden">
			<label>tr('contentCustom')</label>
			<select name="contentElement">
				<option value="0">tr('pleaseSelect')</option>
				<?php foreach ($contentElements as $contentElement) { ?>
				<option value="<?php echo $contentElement->uid; ?>"><?php echo $contentElement->title; ?></option>
				<?php } ?>
			</select>
			</div>
		</form>
	</div>
<div class="clearfix"></div>
<div id="desktop">
	<div id="editFrame">
		<form id="editFrameForm">
		<?php echo $compiledTemplatebodyRaw; ?> 
		<input type="hidden" value="<?php echo $mailobjectuid; ?>" name="mailobjectUid" id="mailobjectUid">
		</form>
	
	</div>
	<div id="campaignCreateElements">
		
		<?php foreach ($cElements as $cElement) { ?><?php if ($cElement->sourcecode != '') { ?><div class="cElementThumbWrapper"><span><?php echo $cElement->title; ?></span>
			<div class="cElementThumb">
				<?php echo $cElement->sourcecode; ?>
			</div>
		</div>
		<?php } ?>
        <?php } ?>
		
	</div>	
	<div class="clearfix"></div>
</div>
	
</div>	
<div id="viewFrame">
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:80%; min-height:100%;" src="<?php echo $source; ?>" ></iframe>
</div>
<?php } ?>
