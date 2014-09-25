<?php use Phalcon\Tag as Tag ?>

<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?><?php if ($this->session->get('auth')) { ?><div class="container">
<div id="menuWrapper" class="clearfix">
	<div id="activityModeBar"><h1><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('activeModeTitle'); ?></h1><h2 class="mode active"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailUpdateModeArrange'); ?></h2><div class="mode glyphicon glyphicon-retweet"></div><h2 class="mode inactive"><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('mailUpdateModeEdit'); ?></h2>
			
		</div>
<div id="fileToolBar">
	<div class="glyphicon glyphicon-edit" id="mailobjectEditMode" data-controller="mailobject" data-action="update" title="<?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('edit'); ?>">
	</div>
	<div class="glyphicon glyphicon-floppy-save" id="mailobjectUpdate" data-controller="mailobject" data-action="update" title="<?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('save'); ?>">
	</div>
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
		<div id="templatedCElements">
			<h3><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('templatedCElementsTitle'); ?></h3>
			<?php foreach ($templatedCElements as $templatedCElement) { ?><?php if ($templatedCElement->sourcecode != '') { ?><div class="cElementThumbWrapper"><span><?php echo $templatedCElement->title; ?></span>
				<div class="cElementThumb">
					<?php echo $this->tag->image(array($templatedCElement->templatefilepath)); ?>
					
					<?php echo $templatedCElement->sourcecode; ?>
					
				</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
		<div id="dynamicCElements">
			<h3><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('dynamicCElementsTitle'); ?></h3>
			
			<div class="cElementThumbWrapper"><span>currently none available</span>
				<div class="cElementThumb">
			
				</div>
			</div>
			
		</div>
		<div id="recentCElements">
			<h3><?php echo nltool\Modules\Modules\Frontend\Controllers\ControllerBase::translate('recentCElementsTitle'); ?></h3>
			<?php foreach ($cElements as $cElement) { ?><?php if ($cElement->sourcecode != '') { ?><div class="cElementThumbWrapper"><span><?php echo $cElement->title; ?></span>
				<div class="cElementThumb">
					<?php echo $cElement->sourcecode; ?>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>	
	<div class="clearfix"></div>
</div>
	
</div>	
<div id="viewFrame" style="display:none">
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:80%; min-height:100%;" src="<?php echo $source; ?>" ></iframe>
</div>
<?php } ?>
