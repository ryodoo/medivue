<div class="demandes form">
	<?php echo $this->Form->create('Demande'); ?>
	<div class="page-header">
		<h1 class="title-page">Demande</h1>
		<span class="slogan"></span>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-8">

			<div class="row">
					<div class='col-12'>
	<?php
		echo $this->Form->input('user_id', array('placeholder'=>''));
	?>
	</div>
	<div class='col-12'>
	<?php
		echo $this->Form->input('specialite_id', array('placeholder'=>''));
	?>
	</div>
	<div class='col-12'>
	<?php
		echo $this->Form->input('medecin_id', array('placeholder'=>''));
	?>
	</div>
	<div class='col-12'>
	<?php
		echo $this->Form->input('remarque', array('placeholder'=>''));
	?>
	</div>
	<div class='col-12'>
	<?php
		echo $this->Form->input('etat', array('placeholder'=>''));
	?>
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