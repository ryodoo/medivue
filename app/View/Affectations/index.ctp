<div class="affectations index"></div>
<div class="page-header">
	<h1 class="title-page">Affectations</h1>
	<span class="slogan"></span>
</div>
<div class="col-md-5">
	<div class="search-section">
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input type="text" class="form-control" id="search_input" placeholder="Rechercher" aria-label="Search">
			<button class="btn btn-primary-rounded" type="button"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
		</div>
	</div>
</div>
<div class="col-md-12 filter-section"></div>
<div class="content-table">
	<table class="table table-akdital">
		<thead>
			<tr>
																								<th>set_id</th>
																				<th>specialite_id</th>
																				<th>medecin_id</th>
																				<th>composition_id</th>
																				<th>remarque</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($affectations as $affectation): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($affectation['Set']['id'], array('controller' => 'sets', 'action' => 'view', $affectation['Set']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Specialite']['name'], array('controller' => 'specialites', 'action' => 'view', $affectation['Specialite']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Medecin']['id'], array('controller' => 'medecins', 'action' => 'view', $affectation['Medecin']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($affectation['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $affectation['Composition']['id'])); ?>
		</td>
		<td><?php echo $affectation['Affectation']['remarque']; ?></td>
		<td><?php echo $affectation['Affectation']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $affectation['Affectation']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $affectation['Affectation']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $affectation['Affectation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $affectation['Affectation']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>