<div class="machines index"></div>
<div class="page-header">
	<h1 class="title-page">Machines</h1>
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
																								<th>name</th>
																				<th>remarque</th>
																				<th>ref</th>
																				<th>api</th>
																				<th>type</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($machines as $machine): ?>
	<tr>
		<td><?php echo $machine['Machine']['name']; ?></td>
		<td><?php echo $machine['Machine']['remarque']; ?></td>
		<td><?php echo $machine['Machine']['ref']; ?></td>
		<td><?php echo $machine['Machine']['api']; ?></td>
		<td><?php echo $machine['Machine']['type']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $machine['Machine']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $machine['Machine']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $machine['Machine']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $machine['Machine']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>