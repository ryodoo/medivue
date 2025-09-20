<div class="remplacements index"></div>
<div class="page-header">
	<h1 class="title-page">Remplacements</h1>
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
																				<th>instrument_source_id</th>
																				<th>instrument_cible_id</th>
																				<th>motif</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($remplacements as $remplacement): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($remplacement['User']['name'], array('controller' => 'users', 'action' => 'view', $remplacement['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($remplacement['InstrumentSource']['name'], array('controller' => 'instruments', 'action' => 'view', $remplacement['InstrumentSource']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($remplacement['InstrumentCible']['name'], array('controller' => 'instruments', 'action' => 'view', $remplacement['InstrumentCible']['id'])); ?>
		</td>
		<td><?php echo $remplacement['Remplacement']['motif']; ?></td>
		<td><?php echo $remplacement['Remplacement']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $remplacement['Remplacement']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $remplacement['Remplacement']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $remplacement['Remplacement']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $remplacement['Remplacement']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>