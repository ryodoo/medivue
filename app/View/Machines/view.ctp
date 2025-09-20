<div class="machines view">
	<div class="page-header">
		<h1 class="title-page">Machines</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Machine</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Name'); ?></label>
		<span><?php echo h($machine['Machine']['name']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($machine['Machine']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Ref'); ?></label>
		<span><?php echo h($machine['Machine']['ref']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Api'); ?></label>
		<span><?php echo h($machine['Machine']['api']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Type'); ?></label>
		<span><?php echo h($machine['Machine']['type']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>