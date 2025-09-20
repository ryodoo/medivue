<div class="fournisseurs index"></div>
<div class="page-header">
	<h1 class="title-page">Fournisseurs</h1>
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
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($fournisseurs as $fournisseur): ?>
	<tr>
		<td><?php echo $fournisseur['Fournisseur']['name']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fournisseur['Fournisseur']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fournisseur['Fournisseur']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fournisseur['Fournisseur']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $fournisseur['Fournisseur']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>