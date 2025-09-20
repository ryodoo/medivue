<div class="instruments view">
	<div class="page-header">
		<h1 class="title-page">Instruments</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Instrument</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Composition</label>
		<span>
			<?php echo $this->Html->link($instrument['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $instrument['Composition']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Fournisseur</label>
		<span>
			<?php echo $this->Html->link($instrument['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $instrument['Fournisseur']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Ref'); ?></label>
		<span><?php echo h($instrument['Instrument']['ref']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Name'); ?></label>
		<span><?php echo h($instrument['Instrument']['name']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Nom Comercial'); ?></label>
		<span><?php echo h($instrument['Instrument']['nom_comercial']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Code Fournisseur'); ?></label>
		<span><?php echo h($instrument['Instrument']['code_fournisseur']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Num Lot'); ?></label>
		<span><?php echo h($instrument['Instrument']['num_lot']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Prix'); ?></label>
		<span><?php echo h($instrument['Instrument']['prix']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Etat'); ?></label>
		<span><?php echo h($instrument['Instrument']['etat']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Date Ajout'); ?></label>
		<span><?php echo h($instrument['Instrument']['date_ajout']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Taille'); ?></label>
		<span><?php echo h($instrument['Instrument']['taille']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($instrument['Instrument']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($instrument['Instrument']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>