<div class="trempages view">
	<div class="page-header">
		<h1 class="title-page">Trempages</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">Trempage</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
						<div class="info">
							<label>Bac</label>
							<span>
								<?php echo $this->Html->link($trempage['Bac']['name'], array('controller' => 'bacs', 'action' => 'view', $trempage['Bac']['id'])); ?>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label>Trempé par</label>
							<span>
								<?php echo $this->Html->link($trempage['User']['name'], array('controller' => 'users', 'action' => 'view', $trempage['User']['id'])); ?>
							</span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label><?php echo __('Date Trampage'); ?></label>
							<span><?php echo h($trempage['Trempage']['date_trampage']); ?></span>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<label><?php echo __('Comentaire Trempage'); ?></label>
							<span><?php echo h($trempage['Trempage']['comentaire_trempage']); ?></span>
						</div>
					</div>
					<?php if ($trempage['Trempage']['retirer_par'] != null): ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Retirer Par'); ?></label>
								<span><?php echo $retirer['User']['name']; ?></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Date Retirage'); ?></label>
								<span><?php echo h($trempage['Trempage']['date_retirage']); ?></span>
							</div>
						</div>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Comentaire Retirer'); ?></label>
								<span><?php echo h($trempage['Trempage']['comentaire_retirer']); ?></span>
							</div>
						</div>
					<?php else: ?>
						<div class="col-md-3">
							<div class="info">
								<label><?php echo __('Temps de trempage'); ?></label>
								<span id="timer"></span>
								<?php echo $this->Html->link(__('Retirer'), array('action' => 'retirer', $trempage['Trempage']['bac_id']), array('class' => 'btn btn-danger btn-xs', 'id' => 'btnRetirer', 'style' => 'margin-left:10px;')); ?>
							</div>
						</div>

						<script>
							// Date de départ envoyée par PHP
							var dateTrempage = new Date("<?php echo $trempage['Trempage']['date_trempage']; ?>");

							// Fin = trempage + 20 min
							var fin = new Date(dateTrempage.getTime() + 20 * 60000);

							function updateTimer() {
								var now = new Date();
								var diff = fin - now; // ms

								// On calcule les minutes/secondes, même si négatif
								var minutes = Math.floor(diff / 60000);
								var seconds = Math.floor((diff % 60000) / 1000);

								// Si secondes négatives, on ajuste
								if (seconds < 0) {
									seconds += 60;
									minutes -= 1;
								}

								// Affichage
								var timerElem = document.getElementById("timer");
								timerElem.innerHTML = minutes + " min " + seconds + " sec";

								// Si <= 0 => vert
								if (minutes <= 0 && seconds <= 0) {
									timerElem.style.color = "green";
								} else {
									timerElem.style.color = "red";
								}
							}

							// Met à jour toutes les secondes
							setInterval(updateTimer, 1000);
							updateTimer();
						</script>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>


<h1 class="title-page">Compositions Trempées dans Bac : <?php echo $trempage['Bac']['name']; ?></h1>
	<div class="content-table">
		<table class="table table-akdital">
			<thead>
				<tr>
					<th>composition</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($trempages as $t): ?>
					<tr>
						<td>
							<?php echo $t['Composition']['name']; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>