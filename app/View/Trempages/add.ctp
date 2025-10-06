<div class="trempages form">
	<?php echo $this->Form->create('Trempage'); ?>
	<div class="page-header">
		<h1 class="title-page">Trempage</h1>
		<span class="slogan"></span>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-8">

			<div class="row">
				<?php if (!isset($this->request->data['Trempage']['bloc_id'])): ?>
					<div class='col-12'>
						<?php echo $this->Form->input('bloc_id', array("type" => "text", 'placeholder' => '', "label" => "Code bar bloc")); ?>
					</div>
				<?php endif; ?>
				<div class='col-12'>
					<?php echo $this->Form->input('bac_id', array("type" => "text", 'placeholder' => '', "label" => "Code bar bac")); ?>
				</div>
				<div class='col-12'>
					<?php echo $this->Form->input('user_id', array("type" => "text", 'placeholder' => '', "label" => "Code bar user")); ?>
				</div>
				<div class='col-12'>
					<?php
					echo $this->Form->input('composition_id', array("multiple" => "multiple", 'placeholder' => '', "label" => "Code bar composition")); ?>
				</div>
				<div class='col-12'>
					<?php
					echo $this->Form->input('comentaire_trempage', array('placeholder' => '', "label" => "Remarque")); ?>
				</div>
			</div>

			<div class='submit-section'>
				<button type="submit" class="btn btn-submit">
					<i class="fa-solid fa-paper-plane"></i> Envoyer
				</button>
			</div><?php echo $this->Form->end(); ?>
		</div>
	</div>
	<div class="col"></div>


</div>
</div>