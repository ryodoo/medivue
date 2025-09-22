<div class="demandes view">
	<div class="page-header">
		<h1 class="title-page">Demandes</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Demande</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>User</label>
		<span>
			<?php echo $this->Html->link($demande['User']['name'], array('controller' => 'users', 'action' => 'view', $demande['User']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Specialite</label>
		<span>
			<?php echo $this->Html->link($demande['Specialite']['name'], array('controller' => 'specialites', 'action' => 'view', $demande['Specialite']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Medecin</label>
		<span>
			<?php echo $this->Html->link($demande['Medecin']['name'], array('controller' => 'medecins', 'action' => 'view', $demande['Medecin']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($demande['Demande']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Etat'); ?></label>
		<span><?php echo h($demande['Demande']['etat']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($demande['Demande']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>