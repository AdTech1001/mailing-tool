<?php use Phalcon\Tag as Tag ?>

<div id="messages"><?php echo $this->flashSession->output(); ?></div>
<?php echo $this->getContent(); ?><?php if ($this->session->get('auth')) { ?><div class="container">
	<div id="editFrame">
		<form id="editFrameForm">
		<?php echo $compiledTemplatebodyRaw; ?> 
		<input type="hidden" value="<?php echo $mailobjectuid; ?>" name="mailobjectUid" id="mailobjectUid">
		</form>
	</div>
	
	<div id="campaignCreateElements">
		
	</div>
</div>	
<div id="viewFrame">
	<iframe id="mailobjectFrame" style="border:1px solid; background:#e3e3e3;width:80%; min-height:100%;" src="<?php echo $source; ?>" ></iframe>
</div>
<?php } ?>
