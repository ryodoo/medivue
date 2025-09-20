<div class="remplacements view">
	<div class="page-header">
		<h1 class="title-page">Remplacements</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Remplacement</span>
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
			<?php echo $this->Html->link($remplacement['User']['name'], array('controller' => 'users', 'action' => 'view', $remplacement['User']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Instrument Source</label>
		<span>
			<?php echo $this->Html->link($remplacement['InstrumentSource']['name'], array('controller' => 'instruments', 'action' => 'view', $remplacement['InstrumentSource']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Instrument Cible</label>
		<span>
			<?php echo $this->Html->link($remplacement['InstrumentCible']['name'], array('controller' => 'instruments', 'action' => 'view', $remplacement['InstrumentCible']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Motif'); ?></label>
		<span><?php echo h($remplacement['Remplacement']['motif']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($remplacement['Remplacement']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>