<div class="sets view">
	<div class="page-header">
		<h1 class="title-page">Sets</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Set</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Fournisseur</label>
		<span>
			<?php echo $this->Html->link($set['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $set['Fournisseur']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Ref'); ?></label>
		<span><?php echo h($set['Set']['ref']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Nom'); ?></label>
		<span><?php echo h($set['Set']['nom']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Emplacements'); ?></label>
		<span><?php echo h($set['Set']['emplacements']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Status'); ?></label>
		<span><?php echo h($set['Set']['status']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Instruction'); ?></label>
		<span><?php echo h($set['Set']['instruction']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>