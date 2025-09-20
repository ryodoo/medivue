<div class="anomalies index"></div>
<div class="page-header">
	<h1 class="title-page">Anomalies</h1>
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
																								<th>evenement_id</th>
																				<th>typeanomaly_id</th>
																				<th>instrument_id</th>
																				<th>category</th>
																				<th>commentaire</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($anomalies as $anomaly): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($anomaly['Evenement']['id'], array('controller' => 'evenements', 'action' => 'view', $anomaly['Evenement']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($anomaly['Typeanomaly'][''], array('controller' => 'typeanomalies', 'action' => 'view', $anomaly['Typeanomaly']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($anomaly['Instrument']['name'], array('controller' => 'instruments', 'action' => 'view', $anomaly['Instrument']['id'])); ?>
		</td>
		<td><?php echo $anomaly['Anomaly']['category']; ?></td>
		<td><?php echo $anomaly['Anomaly']['commentaire']; ?></td>
		<td><?php echo $anomaly['Anomaly']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $anomaly['Anomaly']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anomaly['Anomaly']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $anomaly['Anomaly']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $anomaly['Anomaly']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>