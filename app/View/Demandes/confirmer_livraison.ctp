<div class="demandes view">
	<div class="page-header">
		<h1 class="title-page">Confirmer la livraison</h1>
		<span class="slogan"></span>
	</div>
	<div class="row">
		<div class="col"></div>
		<div class="col-8">
			<?php echo $this->Form->create('Demande'); ?>
			<div class="row">
				<div class='col-12'>
					<?php
					echo $this->Form->input('recu_par', array("type" => "text", "label" => "Code barre de réception", 'placeholder' => ''));
					?>
				</div>
				<?php foreach ($data as $k=>$d): ?>
					<div class='col-12'>
						<?php
						echo $this->Form->input("composition.$k.ref", array("label" => "scan : " . $d['name'] . " : " . $d['code'], 'placeholder' => '',"value"=>$d['code'],"type"=>"text"));
						$conforme = array("Non"=>"Non","Oui"=>"Oui");
						echo $this->Form->input("composition.$k.conforme", array( 'placeholder' => '',"options"=>$conforme));
						echo $this->Form->input("composition.$k.remarque", array( 'placeholder' => ''));
						?>
					</div>
				<?php endforeach; ?>

				<div class='submit-section'>
					<button type="submit" class="btn btn-submit">
						<i class="fa-solid fa-paper-plane"></i> Envoyer
					</button>
				</div><?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="col"></div>


	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Type</th>
							<th>Nom</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $d): ?>
							<tr>
								<td><?php echo h($d['type']); ?></td>
								<td><?php echo h($d['name']); ?></td>
								<td><?php
								echo $this->Html->link("Voir détails ", array('controller' => $d['controller'], 'action' => 'view', $d['detail_id']));

								echo $this->Form->postLink("Supprimer la demande", array('action' => 'delete_demandeset', $d['id']), array('confirm' => "Vous êtes sûr?"));

								?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
			</div>
		</div>
	</div>

</div>