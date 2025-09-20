<div class="sets index"></div>
<div class="page-header">
	<h1 class="title-page">Sets</h1>
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
																								<th>fournisseur_id</th>
																				<th>ref</th>
																				<th>nom</th>
																				<th>emplacements</th>
																				<th>status</th>
																				<th>instruction</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($sets as $set): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($set['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $set['Fournisseur']['id'])); ?>
		</td>
		<td><?php echo $set['Set']['ref']; ?></td>
		<td><?php echo $set['Set']['nom']; ?></td>
		<td><?php echo $set['Set']['emplacements']; ?></td>
		<td><?php echo $set['Set']['status']; ?></td>
		<td><?php echo $set['Set']['instruction']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $set['Set']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $set['Set']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $set['Set']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $set['Set']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>