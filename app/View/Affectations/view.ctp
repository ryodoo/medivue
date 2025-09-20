<div class="affectations view">
	<div class="page-header">
		<h1 class="title-page">Affectations</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Affectation</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Set</label>
		<span>
			<?php echo $this->Html->link($affectation['Set']['id'], array('controller' => 'sets', 'action' => 'view', $affectation['Set']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Specialite</label>
		<span>
			<?php echo $this->Html->link($affectation['Specialite']['name'], array('controller' => 'specialites', 'action' => 'view', $affectation['Specialite']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Medecin</label>
		<span>
			<?php echo $this->Html->link($affectation['Medecin']['id'], array('controller' => 'medecins', 'action' => 'view', $affectation['Medecin']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Composition</label>
		<span>
			<?php echo $this->Html->link($affectation['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $affectation['Composition']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($affectation['Affectation']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($affectation['Affectation']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>