<div class="medecins view">
	<div class="page-header">
		<h1 class="title-page">Medecins</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Medecin</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Nom'); ?></label>
		<span><?php echo h($medecin['Medecin']['nom']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Prenom'); ?></label>
		<span><?php echo h($medecin['Medecin']['prenom']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Contact'); ?></label>
		<span><?php echo h($medecin['Medecin']['contact']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($medecin['Medecin']['remarque']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>