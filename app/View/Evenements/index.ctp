<div class="evenements index"></div>
<div class="page-header">
	<h1 class="title-page">Evenements</h1>
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
																								<th>user_id</th>
																				<th>composition_id</th>
																				<th>poste_id</th>
																				<th>machine_id</th>
																				<th>etape_id</th>
																				<th>boucle_id</th>
																				<th>remarque</th>
																				<th>resultat</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($evenements as $evenement): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($evenement['User']['name'], array('controller' => 'users', 'action' => 'view', $evenement['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evenement['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $evenement['Composition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evenement['Poste']['name'], array('controller' => 'postes', 'action' => 'view', $evenement['Poste']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evenement['Machine']['name'], array('controller' => 'machines', 'action' => 'view', $evenement['Machine']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evenement['Etape']['name'], array('controller' => 'etapes', 'action' => 'view', $evenement['Etape']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($evenement['Boucle']['id'], array('controller' => 'boucles', 'action' => 'view', $evenement['Boucle']['id'])); ?>
		</td>
		<td><?php echo $evenement['Evenement']['remarque']; ?></td>
		<td><?php echo $evenement['Evenement']['resultat']; ?></td>
		<td><?php echo $evenement['Evenement']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $evenement['Evenement']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $evenement['Evenement']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $evenement['Evenement']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $evenement['Evenement']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>