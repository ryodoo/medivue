<div class="compositions index"></div>
<div class="page-header">
	<h1 class="title-page">Compositions</h1>
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
				<th>fournisseur_id</th>
				<th>Code</th>
				<th>name</th>
				<th>images</th>
				<th>remarque</th>
				<th>emplacement</th>
				<th>status</th>
				<th>created</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($compositions as $composition): ?>
				<tr>
					<td>
						<?php echo $this->Html->link($composition['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $composition['Fournisseur']['id'])); ?>
					</td>
					<td><?php echo $composition['Composition']['code']; ?></td>
					<td><?php echo $composition['Composition']['name']; ?></td>
					<td><?php echo $composition['Composition']['images']; ?></td>
					<td><?php echo $composition['Composition']['remarque']; ?></td>
					<td><?php echo $composition['Composition']['emplacement']; ?></td>
					<td><?php echo $composition['Composition']['status']; ?></td>
					<td><?php echo $composition['Composition']['created']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $composition['Composition']['id'])); ?>
						/
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $composition['Composition']['id'])); ?>
						/
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $composition['Composition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $composition['Composition']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>