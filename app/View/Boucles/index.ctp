<div class="boucles index"></div>
<div class="page-header">
	<h1 class="title-page">Boucles</h1>
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
																								<th>code_patient</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($boucles as $boucle): ?>
	<tr>
		<td><?php echo $boucle['Boucle']['code_patient']; ?></td>
		<td><?php echo $boucle['Boucle']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $boucle['Boucle']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $boucle['Boucle']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $boucle['Boucle']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $boucle['Boucle']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>