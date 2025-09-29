<div class="demandes index"></div>
<div class="page-header">
	<h1 class="title-page">Demandes</h1>
	<span class="slogan"></span>
</div>
<div class="col-md-5">
	<div class="search-section">

		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input type="text" class="form-control" id="search_input" placeholder="Rechercher" aria-label="Search">
			<button class="btn btn-primary-rounded" type="button"><i class="fa-solid fa-magnifying-glass"></i>
				Rechercher</button>
		</div>
	</div>
</div>
<div class="col-md-12 filter-section"></div>
<div class="content-table">
	<table class="table table-akdital">
		<thead>
			<tr>
				<th>user_id</th>
				<th>Bloc opératoire</th>
				<th>specialite_id</th>
				<th>medecin_id</th>
				<th>remarque</th>
				<th>etat</th>
				<th>created</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($demandes as $demande): ?>
				<tr>
					<td>
						<?php echo $demande['User']['name']; ?>
					</td>
					<td>
						<?php echo $demande['Bloc']['name']; ?>
					</td>
					<td>
						<?php echo $demande['Medecin']['name']?>
					</td>
					<td><?php echo $demande['Demande']['remarque']; ?></td>
					<td><?php echo $demande['Demande']['etat']; ?></td>
					<td><?php echo $demande['Demande']['created']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $demande['Demande']['id'])); ?> /
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $demande['Demande']['id'])); ?> /
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $demande['Demande']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $demande['Demande']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>