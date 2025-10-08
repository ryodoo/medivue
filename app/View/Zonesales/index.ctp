<div class="zonesales index"></div>
<div class="page-header">
	<h1 class="title-page">Zonesales</h1>
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
																								<th>poste_id</th>
																				<th>user_id</th>
																				<th>remarque</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zonesales as $zonesale): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($zonesale['Poste']['name'], array('controller' => 'postes', 'action' => 'view', $zonesale['Poste']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($zonesale['User']['name'], array('controller' => 'users', 'action' => 'view', $zonesale['User']['id'])); ?>
		</td>
		<td><?php echo $zonesale['Zonesale']['remarque']; ?></td>
		<td><?php echo $zonesale['Zonesale']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $zonesale['Zonesale']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $zonesale['Zonesale']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $zonesale['Zonesale']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $zonesale['Zonesale']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>