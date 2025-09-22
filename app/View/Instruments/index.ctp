<div class="instruments index"></div>
<div class="page-header">
	<h1 class="title-page">Instruments</h1>
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
																								<th>composition_id</th>
																				<th>fournisseur_id</th>
																				<th>ref</th>
																				<th>name</th>
																				<th>nom_comercial</th>
																				<th>code_fournisseur</th>
																				<th>num_lot</th>
																				<th>prix</th>
																				<th>etat</th>
																				<th>date_ajout</th>
																				<th>taille</th>
																				<th>remarque</th>
																				<th>image</th>
																				<th>coordonnees_image</th>
																				<th>type_lavage</th>
																				<th>created</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($instruments as $instrument): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($instrument['Composition']['name'], array('controller' => 'compositions', 'action' => 'view', $instrument['Composition']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($instrument['Fournisseur']['name'], array('controller' => 'fournisseurs', 'action' => 'view', $instrument['Fournisseur']['id'])); ?>
		</td>
		<td><?php echo $instrument['Instrument']['ref']; ?></td>
		<td><?php echo $instrument['Instrument']['name']; ?></td>
		<td><?php echo $instrument['Instrument']['nom_comercial']; ?></td>
		<td><?php echo $instrument['Instrument']['code_fournisseur']; ?></td>
		<td><?php echo $instrument['Instrument']['num_lot']; ?></td>
		<td><?php echo $instrument['Instrument']['prix']; ?></td>
		<td><?php echo $instrument['Instrument']['etat']; ?></td>
		<td><?php echo $instrument['Instrument']['date_ajout']; ?></td>
		<td><?php echo $instrument['Instrument']['taille']; ?></td>
		<td><?php echo $instrument['Instrument']['remarque']; ?></td>
		<td><?php echo $instrument['Instrument']['image']; ?></td>
		<td><?php echo $instrument['Instrument']['coordonnees_image']; ?></td>
		<td><?php echo $instrument['Instrument']['type_lavage']; ?></td>
		<td><?php echo $instrument['Instrument']['created']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $instrument['Instrument']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $instrument['Instrument']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $instrument['Instrument']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $instrument['Instrument']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>