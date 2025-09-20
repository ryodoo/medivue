<div class="compositions view">
	<div class="page-header">
		<h1 class="title-page">Compositions</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Composition</span>
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
			<?php echo $this->Html->link($composition['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $composition['Fournisseur']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Set</label>
		<span>
			<?php echo $this->Html->link($composition['Set']['id'], array('controller' => 'sets', 'action' => 'view', $composition['Set']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Ref'); ?></label>
		<span><?php echo h($composition['Composition']['ref']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Name'); ?></label>
		<span><?php echo h($composition['Composition']['name']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Images'); ?></label>
		<span><?php echo h($composition['Composition']['images']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($composition['Composition']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Emplacement'); ?></label>
		<span><?php echo h($composition['Composition']['emplacement']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Status'); ?></label>
		<span><?php echo h($composition['Composition']['status']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($composition['Composition']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>