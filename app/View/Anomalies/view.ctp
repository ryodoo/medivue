<div class="anomalies view">
	<div class="page-header">
		<h1 class="title-page">Anomalies</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Anomaly</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Evenement</label>
		<span>
			<?php echo $this->Html->link($anomaly['Evenement']['id'], array('controller' => 'evenements', 'action' => 'view', $anomaly['Evenement']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Typeanomaly</label>
		<span>
			<?php echo $this->Html->link($anomaly['Typeanomaly'][''], array('controller' => 'typeanomalies', 'action' => 'view', $anomaly['Typeanomaly']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Instrument</label>
		<span>
			<?php echo $this->Html->link($anomaly['Instrument']['name'], array('controller' => 'instruments', 'action' => 'view', $anomaly['Instrument']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Category'); ?></label>
		<span><?php echo h($anomaly['Anomaly']['category']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Commentaire'); ?></label>
		<span><?php echo h($anomaly['Anomaly']['commentaire']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($anomaly['Anomaly']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>