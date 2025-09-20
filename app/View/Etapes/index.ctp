<div class="etapes index"></div>
<div class="page-header">
	<h1 class="title-page">Etapes</h1>
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
																				<th>ordre</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($etapes as $etape): ?>
	<tr>
		<td><?php echo $etape['Etape']['name']; ?></td>
		<td><?php echo $etape['Etape']['ordre']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $etape['Etape']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $etape['Etape']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $etape['Etape']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $etape['Etape']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>