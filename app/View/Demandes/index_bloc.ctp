<div class="demandes index"></div>
<div class="page-header">
	<h1 class="title-page">Demandes</h1>
	<span class="slogan"></span>
</div>
<div class="col-md-5">
	<div class="search-section">

		<?php echo $this->Form->create('Demande'); ?>
		<?php echo $this->Form->input('bloc_id', array("maxlength"=>25,"type" => "text","label" => "Code bar du bloc opératoire", 'placeholder' => '')); ?>
		<?php echo $this->Form->end(array('label' => 'Rechercher', 'class' => 'btn btn-primary-rounded')); ?>
	</div>
</div>
<div class="col-md-12 filter-section"></div>
<div class="content-table">
	<table class="table table-akdital">
		<thead>
			<tr>
				<th>user_id</th>
				<th>Bloc opératoire</th>
				<th>specialite_id</th>
				<th>medecin_id</th>
				<th>remarque</th>
				<th>etat</th>
				<th>created</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($demandes as $demande): ?>
				<tr>
					<td>
						<?php echo $demande['User']['name']; ?>
					</td>
					<td>
						<?php echo $demande['Bloc']['name']; ?>
					</td>
					<td>
						<?php echo $demande['Medecin']['name']?>
					</td>
					<td><?php echo $demande['Demande']['remarque']; ?></td>
					<td><?php echo $demande['Demande']['etat']; ?></td>
					<td><?php echo $demande['Demande']['created']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array('action' => 'view', $demande['Demande']['id'])); ?> /
						<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $demande['Demande']['id'])); ?> /
						<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $demande['Demande']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $demande['Demande']['id']))); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>