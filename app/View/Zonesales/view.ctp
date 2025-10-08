<div class="zonesales view">
	<div class="page-header">
		<h1 class="title-page">Zonesales</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Zonesale</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Poste</label>
		<span>
			<?php echo $this->Html->link($zonesale['Poste']['name'], array('controller' => 'postes', 'action' => 'view', $zonesale['Poste']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>User</label>
		<span>
			<?php echo $this->Html->link($zonesale['User']['name'], array('controller' => 'users', 'action' => 'view', $zonesale['User']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($zonesale['Zonesale']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($zonesale['Zonesale']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>