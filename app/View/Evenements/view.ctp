<div class="evenements view">
	<div class="page-header">
		<h1 class="title-page">Evenements</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Evenement</span>
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
			<?php echo $this->Html->link($evenement['User']['name'], array('controller' => 'users', 'action' => 'view', $evenement['User']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Composition</label>
		<span>
			<?php echo $this->Html->link($evenement['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $evenement['Composition']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Poste</label>
		<span>
			<?php echo $this->Html->link($evenement['Poste']['name'], array('controller' => 'postes', 'action' => 'view', $evenement['Poste']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Machine</label>
		<span>
			<?php echo $this->Html->link($evenement['Machine']['name'], array('controller' => 'machines', 'action' => 'view', $evenement['Machine']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Etape</label>
		<span>
			<?php echo $this->Html->link($evenement['Etape']['name'], array('controller' => 'etapes', 'action' => 'view', $evenement['Etape']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label>Boucle</label>
		<span>
			<?php echo $this->Html->link($evenement['Boucle']['id'], array('controller' => 'boucles', 'action' => 'view', $evenement['Boucle']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Remarque'); ?></label>
		<span><?php echo h($evenement['Evenement']['remarque']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Resultat'); ?></label>
		<span><?php echo h($evenement['Evenement']['resultat']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($evenement['Evenement']['created']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>