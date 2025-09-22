<div class="etapes view">
	<div class="page-header">
		<h1 class="title-page">Etapes</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Etape</span>
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
		<span><?php echo h($etape['Etape']['name']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Description'); ?></label>
		<span><?php echo h($etape['Etape']['description']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Ordre'); ?></label>
		<span><?php echo h($etape['Etape']['ordre']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>