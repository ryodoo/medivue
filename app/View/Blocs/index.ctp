<div class="blocs index"></div>
<div class="page-header">
	<h1 class="title-page">Blocs</h1>
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
																				<th>ref</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($blocs as $bloc): ?>
	<tr>
		<td><?php echo $bloc['Bloc']['name']; ?></td>
		<td><?php echo $bloc['Bloc']['ref']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bloc['Bloc']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bloc['Bloc']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bloc['Bloc']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $bloc['Bloc']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>