<div class="demandes view">
	<div class="page-header">
		<h1 class="title-page">Demandes</h1>
		<span class="slogan"></span>
	</div>

	<?php
	if ($demande["Demande"]["etat"] == "Demande en cours")
		echo $this->Html->link(__('Lancer la livraison'), array('action' => 'lancer_livraison', $demande["Demande"]["id"]), array('class' => 'btn btn-primary-rounded mb-3'));
	else if ($demande["Demande"]["etat"] == "En cours de livraison")
		echo $this->Html->link(__('Confirmer la livraison'), array('action' => 'confirmer_livraison', $demande["Demande"]["id"]), array('class' => 'btn btn-primary-rounded mb-3'));
	?>

	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
						<div class="info">
							<label>User</label>
							<span>
								<?php echo $this->Html->link($demande['User']['name'], array('controller' => 'users', 'action' => 'view', $demande['User']['id'])); ?>
							</span>
						</div>
					</div>
					<?php if (isset($users[$demande['Demande']['livrer_par']])): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Livrer Par'); ?></label>
								<span>
									<?php echo $users[$demande['Demande']['livrer_par']]; ?></span>
							</div>
						</div>
					<?php endif; ?>
					<?php if (isset($users[$demande['Demande']['stock_par']])): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Stock Par'); ?></label>
								<span><?php echo $users[$demande['Demande']['stock_par']]; ?></span>
							</div>
						</div>
					<?php endif; ?>
					<?php if (isset($users[$demande['Demande']['recu_par']])): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Recu Par'); ?></label>
								<span><?php echo $users[$demande['Demande']['recu_par']]; ?></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="col-md-3">
						<div class="info">
							<label>Specialite</label>
							<span>
								<?php echo $this->Html->link($demande['Specialite']['name'], array('controller' => 'specialites', 'action' => 'view', $demande['Specialite']['id'])); ?>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label>Medecin</label>
							<span>
								<?php echo $this->Html->link($demande['Medecin']['name'], array('controller' => 'medecins', 'action' => 'view', $demande['Medecin']['id'])); ?>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label><?php echo __('Remarque'); ?></label>
							<span><?php echo h($demande['Demande']['remarque']); ?></span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label><?php echo __('Etat'); ?></label>
							<span><?php echo h($demande['Demande']['etat']); ?></span>
						</div>
					</div>

					<div class="col-md-3">
						<div class="info">
							<label><?php echo __('Date demande'); ?></label>
							<span><?php echo h($demande['Demande']['created']); ?></span>
						</div>
					</div>
					<?php if (isset($demande['Demande']['date_livraison'])): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Date livraison'); ?></label>
								<span><?php echo h($demande['Demande']['date_livraison']); ?></span>
							</div>
						</div>
					<?php endif; ?>
					<?php if (isset($demande['Demande']['confirmer_livraison'])): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Date confirmation livraison'); ?></label>
								<span><?php echo h($demande['Demande']['confirmer_livraison']); ?></span>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<h4 class="mt-4 mb-3">Détails de la demande</h4>

	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Composition</th>
							<th>Emplacement</th>
							<th>Conforme</th>
							<th>Remarque</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($demande['Demandecomposition'] as $d): ?>
							<tr>
								<td><?php echo $compositions[$d['composition_id']]; ?></td>
								<td><?php echo $compositions[$d['composition_id']]; ?></td>
								<td><?php echo h($d['conforme']); ?></td>
								<td><?php echo h($d['remarque']); ?></td>
								<td><?php
								echo $this->Html->link("Voir détails ", array('controller' => 'Compositions', 'action' => 'view', $d['composition_id']));

								echo $this->Form->postLink("Supprimer la demande", array('action' => 'delete_demandecomposition', $d['id']), array('confirm' => "Vous êtes sûr?"));

								?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
			</div>
		</div>
	</div>

</div>