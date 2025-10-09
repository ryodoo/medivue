<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="instruments index">
	<div class="page-header-modern">
		<h1 class="title-page">Instruments</h1>
		<?php echo $this->Html->link(
			'Nouveau Instrument',
			array('action' => 'add2'),
			array('escape' => false, 'class' => 'btn-create')
		); ?>
	</div>

	<div class="table-container">
		<div class="table-controls">
			<div class="search-wrapper">
				<i class="fa-solid fa-magnifying-glass search-icon"></i>
				<input type="text" class="search-input" id="search_input" placeholder="Rechercher...">
			</div>
		</div>

		<div class="table-wrapper">
			<table class="modern-table">
				<thead>
				<tr class="header-row">
					<th style="width: 80px;">Photo</th>
					<th>Code</th>
					<th>Référence</th>
					<th>Nom</th>
					<th>Fournisseur</th>
					<th>Code Fournisseur</th>
					<th>État</th>
					<th>Remarque</th>
					<th>Création</th>
					<th class="actions-col">Actions</th>
				</tr>
				<tr class="filter-row">
					<td></td>
					<td><input type="text" placeholder="Code..." class="filter-input" data-column="code"></td>
					<td><input type="text" placeholder="Réf..." class="filter-input" data-column="ref"></td>
					<td><input type="text" placeholder="Nom..." class="filter-input" data-column="name"></td>
					<td><input type="text" placeholder="Fournisseur..." class="filter-input" data-column="fournisseur"></td>
					<td><input type="text" placeholder="Code fourn..." class="filter-input" data-column="code_fournisseur"></td>
					<td><input type="text" placeholder="État..." class="filter-input" data-column="etat"></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</thead>
				<tbody id="tableBody">
				<?php foreach ($instruments as $instrument): ?>
					<tr>
						<td class="photo-cell">
							<?php if (!empty($instrument['Instrument']['image'])): ?>
								<img src="<?php echo $this->webroot . $instrument['Instrument']['image']; ?>"
									 alt="Photo"
									 class="instrument-photo">
							<?php else: ?>
								<div class="no-photo">
									<i class="fa fa-image"></i>
								</div>
							<?php endif; ?>
						</td>
						<td class="font-medium" title="<?php echo h($instrument['Instrument']['code']); ?>"><?php echo h($instrument['Instrument']['code']); ?></td>
						<td title="<?php echo h($instrument['Instrument']['ref']); ?>"><?php echo h($instrument['Instrument']['ref']); ?></td>
						<td class="font-medium" title="<?php echo h($instrument['Instrument']['name']); ?>"><?php echo h($instrument['Instrument']['name']); ?></td>
						<td title="<?php echo h($instrument['Fournisseur']['name']); ?>"><?php echo h($instrument['Fournisseur']['name']); ?></td>
						<td title="<?php echo h($instrument['Instrument']['code_fournisseur']); ?>"><?php echo h($instrument['Instrument']['code_fournisseur']); ?></td>
						<td>
                            <span class="status-badge status-<?php echo strtolower($instrument['Instrument']['etat']); ?>">
                                <?php echo h($instrument['Instrument']['etat']); ?>
                            </span>
						</td>
						<td class="remarque-cell" title="<?php echo h($instrument['Instrument']['remarque']); ?>">
							<?php if (!empty($instrument['Instrument']['remarque'])): ?>
								<?php echo h($instrument['Instrument']['remarque']); ?>
							<?php endif; ?>
						</td>
						<td title="<?php echo date('n/j/Y, g:i:s A', strtotime($instrument['Instrument']['created'])); ?>"><?php echo date('n/j/Y, g:i:s A', strtotime($instrument['Instrument']['created'])); ?></td>
						<td class="actions-col">
							<div class="dropdown">
								<button class="btn-actions" type="button">
									<i class="fa fa-ellipsis-v"></i>
								</button>
								<div class="dropdown-menu">
									<?php echo $this->Html->link(
										'<i class="fa fa-eye"></i> Voir',
										array('action' => 'view', $instrument['Instrument']['id']),
										array('escape' => false, 'class' => 'dropdown-item')
									); ?>
									<?php echo $this->Html->link(
										'<i class="fa fa-pencil"></i> Modifier',
										array('action' => 'edit', $instrument['Instrument']['id']),
										array('escape' => false, 'class' => 'dropdown-item')
									); ?>
									<?php echo $this->Form->postLink(
										'<i class="fa fa-trash"></i> Supprimer',
										array('action' => 'delete', $instrument['Instrument']['id']),
										array(
											'escape' => false,
											'class' => 'dropdown-item text-danger',
											'confirm' => 'Êtes-vous sûr de vouloir supprimer cet instrument?'
										)
									); ?>
								</div>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<div class="table-footer">
			<div class="pagination-info" id="paginationInfo">
				<?php
				echo $this->Paginator->counter(array(
					'format' => 'Page {:page} sur {:pages}, affichant {:current} résultats sur {:count} au total'
				));
				?>
			</div>
			<div class="pagination-controls" id="paginationControls">
				<button class="btn-pagination" id="prevBtn">Précédent</button>
				<button class="btn-pagination" id="nextBtn">Suivant</button>
			</div>
		</div>
	</div>

	<div class="loading-overlay" id="loadingOverlay">
		<div class="spinner"></div>
	</div>
</div>

<style>
	@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

	.instruments.index {
		font-family: "Poppins", sans-serif;
		padding: 1.5rem 2rem;
		background-color: #f8fafc;
		min-height: 100vh;
	}

	.page-header-modern {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 1.5rem;
	}

	.title-page {
		font-size: 1.5rem;
		font-weight: 600;
		color: #1a202c;
		margin: 0;
	}

	.btn-create {
		background-color: #10b981;
		color: white;
		border: none;
		border-radius: 8px;
		padding: 0.65rem 1.25rem;
		font-size: 0.875rem;
		font-weight: 500;
		cursor: pointer;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.2s ease;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
		text-decoration: none;
	}

	.btn-create:hover {
		background-color: #059669;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		color: white;
	}

	.table-container {
		background: white;
		border-radius: 12px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		border: 1px solid #e2e8f0;
		overflow: hidden;
	}

	.table-controls {
		padding: 1rem 1.25rem;
		border-bottom: 1px solid #e5e7eb;
	}

	.search-wrapper {
		position: relative;
		max-width: 320px;
	}

	.search-icon {
		position: absolute;
		left: 0.875rem;
		top: 50%;
		transform: translateY(-50%);
		color: #94a3b8;
		font-size: 0.875rem;
		transition: opacity 0.2s ease;
	}

	.search-icon.loading {
		animation: spin 0.8s linear infinite;
		color: #10b981;
	}

	.search-input {
		width: 100%;
		padding: 0.625rem 0.875rem 0.625rem 2.5rem;
		border: 1.5px solid #e5e7eb;
		border-radius: 8px;
		font-size: 0.875rem;
		font-family: "Poppins", sans-serif;
		font-weight: 300;
		color: #1a202c;
		background: white;
		transition: all 0.2s ease;
	}

	.search-input:focus {
		outline: none;
		border-color: #10b981;
		box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
	}

	.search-input::placeholder {
		color: #94a3b8;
	}

	.table-wrapper {
		overflow-x: auto;
	}

	.modern-table {
		width: 100%;
		border-collapse: collapse;
		font-size: 0.875rem;
	}

	.modern-table thead .header-row th {
		background-color: #f8fafc;
		padding: 0.875rem 1rem;
		text-align: left;
		font-size: 0.8125rem;
		font-weight: 600;
		color: #475569;
		border-bottom: 1px solid #e5e7eb;
		white-space: nowrap;
	}

	.filter-row td {
		padding: 0.625rem 1rem;
		background-color: #ffffff;
		border-bottom: 1px solid #e5e7eb;
	}

	.filter-input {
		width: 100%;
		padding: 0.5rem 0.75rem;
		border: 1.5px solid #e5e7eb;
		border-radius: 6px;
		font-size: 0.8125rem;
		font-family: "Poppins", sans-serif;
		font-weight: 300;
		color: #1a202c;
		background: white;
		transition: all 0.2s ease;
	}

	.filter-input:focus {
		outline: none;
		border-color: #10b981;
		box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1);
	}

	.filter-input::placeholder {
		color: #cbd5e1;
	}

	.modern-table tbody {
		transition: opacity 0.2s ease;
	}

	.modern-table tbody tr {
		border-bottom: 1px solid #e5e7eb;
		transition: background-color 0.15s ease;
	}

	.modern-table tbody tr:hover {
		background-color: #f8fafc;
	}

	.modern-table tbody td {
		padding: 1rem;
		color: #475569;
		font-weight: 300;
		max-width: 200px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.font-medium {
		font-weight: 500;
		color: #1a202c;
	}

	.photo-cell {
		width: 80px;
		padding: 0.5rem !important;
		overflow: visible !important;
	}

	.instrument-photo {
		width: 50px;
		height: 50px;
		object-fit: cover;
		border-radius: 6px;
		border: 1px solid #e5e7eb;
	}

	.no-photo {
		width: 50px;
		height: 50px;
		display: flex;
		align-items: center;
		justify-content: center;
		background: #f8fafc;
		border-radius: 6px;
		border: 1px solid #e5e7eb;
		color: #cbd5e1;
	}

	.remarque-cell {
		max-width: 200px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.remarque-preview {
		display: block;
		color: #64748b;
		font-size: 0.8125rem;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.actions-col {
		width: 60px;
		text-align: center;
		overflow: visible !important;
		white-space: normal !important;
	}

	.modern-table tbody td:nth-child(2) {
		max-width: 120px;
	}

	.modern-table tbody td:nth-child(3) {
		max-width: 120px;
	}

	.modern-table tbody td:nth-child(4) {
		max-width: 180px;
	}

	.modern-table tbody td:nth-child(5) {
		max-width: 150px;
	}

	.modern-table tbody td:nth-child(6) {
		max-width: 140px;
	}

	.modern-table tbody td:nth-child(7) {
		max-width: 100px;
		overflow: visible !important;
	}

	.modern-table tbody td:nth-child(8) {
		max-width: 200px;
	}

	.modern-table tbody td:nth-child(9) {
		max-width: 180px;
	}

	.table-link {
		color: #10b981;
		text-decoration: none;
		font-weight: 400;
		transition: color 0.15s ease;
	}

	.table-link:hover {
		color: #059669;
	}

	.status-badge {
		display: inline-flex;
		align-items: center;
		padding: 0.25rem 0.625rem;
		border-radius: 12px;
		font-size: 0.75rem;
		font-weight: 500;
	}

	.status-actif {
		background-color: #dcfce7;
		color: #166534;
	}

	.status-inactif {
		background-color: #fee2e2;
		color: #991b1b;
	}

	.status-en-cours {
		background-color: #dbeafe;
		color: #1e40af;
	}

	.dropdown {
		position: relative;
		display: inline-block;
	}

	.btn-actions {
		background: none;
		border: none;
		cursor: pointer;
		padding: 0.5rem;
		color: #1a202c;
		border-radius: 6px;
		transition: background-color 0.15s ease;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2rem;
		width: 32px;
		height: 32px;
	}

	.btn-actions:hover {
		background-color: #f1f5f9;
		color: #1a202c;
	}

	.btn-actions.active {
		background-color: #e5e7eb;
		color: #1a202c;
	}

	.btn-actions i {
		pointer-events: none;
		color: #1a202c;
	}

	.dropdown-menu {
		display: none;
		position: absolute;
		right: 0;
		top: 100%;
		background: white;
		border: 1.5px solid #e5e7eb;
		border-radius: 8px;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		min-width: 160px;
		z-index: 1000;
		margin-top: 0.25rem;
		overflow: hidden;
	}

	.dropdown-menu.show {
		display: block;
	}

	.dropdown-item {
		display: flex;
		align-items: center;
		gap: 0.625rem;
		padding: 0.75rem 1rem;
		color: #475569;
		text-decoration: none;
		font-size: 0.875rem;
		font-weight: 400;
		transition: background-color 0.15s ease;
		border: none;
		background: none;
		width: 100%;
		text-align: left;
	}

	.dropdown-item:hover {
		background-color: #f8fafc;
		color: #475569;
	}

	.dropdown-item i {
		width: 14px;
		font-size: 0.875rem;
	}

	.dropdown-item.text-danger {
		color: #dc2626;
	}

	.dropdown-item.text-danger:hover {
		background-color: #fef2f2;
		color: #dc2626;
	}

	.table-footer {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 1rem 1.25rem;
		border-top: 1px solid #e5e7eb;
		background-color: #fafbfc;
	}

	.pagination-info {
		font-size: 0.875rem;
		color: #64748b;
		font-weight: 400;
	}

	.pagination-controls {
		display: flex;
		gap: 0.5rem;
	}

	.btn-pagination {
		padding: 0.5rem 1rem;
		border: 1.5px solid #e5e7eb;
		background: white;
		border-radius: 6px;
		font-size: 0.875rem;
		font-family: "Poppins", sans-serif;
		font-weight: 400;
		color: #475569;
		cursor: pointer;
		transition: all 0.2s ease;
	}

	.btn-pagination:hover:not(.disabled) {
		background-color: #f8fafc;
		border-color: #cbd5e1;
	}

	.btn-pagination.disabled {
		opacity: 0.5;
		cursor: not-allowed;
	}

	.loading-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(255, 255, 255, 0.8);
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 9999;
	}

	.loading-overlay.active {
		display: flex;
	}

	.spinner {
		width: 50px;
		height: 50px;
		border: 4px solid #e5e7eb;
		border-top-color: #10b981;
		border-radius: 50%;
		animation: spin 0.8s linear infinite;
	}

	@keyframes spin {
		to { transform: rotate(360deg); }
	}

	@media (max-width: 768px) {
		.instruments.index {
			padding: 1rem;
		}

		.page-header-modern {
			flex-direction: column;
			align-items: flex-start;
			gap: 1rem;
		}

		.btn-create {
			width: 100%;
			justify-content: center;
		}

		.table-controls {
			padding: 1rem;
		}

		.search-wrapper {
			max-width: 100%;
		}

		.table-wrapper {
			overflow-x: scroll;
		}

		.modern-table {
			min-width: 1000px;
		}

		.table-footer {
			flex-direction: column;
			gap: 1rem;
			align-items: flex-start;
		}

		.pagination-controls {
			width: 100%;
			justify-content: space-between;
		}

		.btn-pagination {
			flex: 1;
		}
	}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	let searchTimeout;
	let currentPage = 1;

	$(document).ready(function() {
		$('#search_input').on('input', function() {
			clearTimeout(searchTimeout);
			searchTimeout = setTimeout(() => {
				currentPage = 1;
				loadInstruments();
			}, 300);
		});

		$('.filter-input').on('input', function() {
			clearTimeout(searchTimeout);
			searchTimeout = setTimeout(() => {
				currentPage = 1;
				loadInstruments();
			}, 300);
		});

		$('#prevBtn').on('click', function() {
			if (!$(this).hasClass('disabled') && currentPage > 1) {
				currentPage--;
				loadInstruments();
			}
		});

		$('#nextBtn').on('click', function() {
			if (!$(this).hasClass('disabled')) {
				currentPage++;
				loadInstruments();
			}
		});
	});

	function loadInstruments() {
		$('#tableBody').css('opacity', '0.5');

		const params = {
			page: currentPage
		};

		const globalSearch = $('#search_input').val().trim();
		if (globalSearch) {
			params.search = globalSearch;
		}

		$('.filter-input').each(function() {
			const value = $(this).val().trim();
			const column = $(this).data('column');
			if (value) {
				params['filter_' + column] = value;
			}
		});

		$.ajax({
			url: '<?php echo $this->Html->url(array("action" => "index")); ?>',
			type: 'GET',
			data: params,
			dataType: 'json',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
			success: function(response) {
				if (response.success) {
					updateTable(response.instruments);
					updatePagination(response.paging);
				}
			},
			error: function(xhr, status, error) {
				console.error('Error loading instruments:', error);
				alert('Erreur lors du chargement des instruments');
				$('#tableBody').css('opacity', '1');
			}
		});
	}

	function updateTable(instruments) {
		const tbody = $('#tableBody');
		let newContent = '';
		const webroot = '<?php echo $this->webroot; ?>';

		if (instruments.length === 0) {
			newContent = '<tr><td colspan="10" style="text-align: center; padding: 2rem; color: #94a3b8;">Aucun résultat trouvé</td></tr>';
		} else {
			instruments.forEach(function(item) {
				const instrument = item.Instrument;
				const fournisseur = item.Fournisseur;

				const date = new Date(instrument.created);
				const formattedDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear() +
					', ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds() +
					' ' + (date.getHours() >= 12 ? 'PM' : 'AM');

				const photoHtml = instrument.image
					? `<img src="${webroot}${escapeHtml(instrument.image)}" alt="Photo" class="instrument-photo">`
					: '<div class="no-photo"><i class="fa fa-image"></i></div>';

				newContent += `
				<tr>
					<td class="photo-cell">${photoHtml}</td>
					<td class="font-medium" title="${escapeHtml(instrument.code || '')}">${escapeHtml(instrument.code || '')}</td>
					<td title="${escapeHtml(instrument.ref || '')}">${escapeHtml(instrument.ref || '')}</td>
					<td class="font-medium" title="${escapeHtml(instrument.name || '')}">${escapeHtml(instrument.name || '')}</td>
					<td title="${escapeHtml(fournisseur.name || '')}">${escapeHtml(fournisseur.name || '')}</td>
					<td title="${escapeHtml(instrument.code_fournisseur || '')}">${escapeHtml(instrument.code_fournisseur || '')}</td>
					<td>
						<span class="status-badge status-${instrument.etat ? instrument.etat.toLowerCase() : ''}">
							${escapeHtml(instrument.etat || '')}
						</span>
					</td>
					<td class="remarque-cell" title="${escapeHtml(instrument.remarque || '')}">${escapeHtml(instrument.remarque || '')}</td>
					<td title="${formattedDate}">${formattedDate}</td>
					<td class="actions-col">
						<div class="dropdown">
							<button class="btn-actions" type="button">
								<i class="fa fa-ellipsis-v"></i>
							</button>
							<div class="dropdown-menu">
								<a href="<?php echo $this->Html->url(array('action' => 'view')); ?>/${instrument.id}" class="dropdown-item">
									<i class="fa fa-eye"></i> Voir
								</a>
								<a href="<?php echo $this->Html->url(array('action' => 'edit')); ?>/${instrument.id}" class="dropdown-item">
									<i class="fa fa-pencil"></i> Modifier
								</a>
								<form method="post" action="<?php echo $this->Html->url(array('action' => 'delete')); ?>/${instrument.id}"
									  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet instrument?');" style="display: inline;">
									<button type="submit" class="dropdown-item text-danger" style="cursor: pointer;">
										<i class="fa fa-trash"></i> Supprimer
									</button>
								</form>
							</div>
						</div>
					</td>
				</tr>
			`;
			});
		}

		tbody.html(newContent);
		tbody.css('opacity', '1');
	}

	function updatePagination(paging) {
		const info = `Page ${paging.page} sur ${paging.pageCount}, affichant ${paging.current} résultats sur ${paging.count} au total`;
		$('#paginationInfo').text(info);

		if (paging.prevPage) {
			$('#prevBtn').removeClass('disabled');
		} else {
			$('#prevBtn').addClass('disabled');
		}

		if (paging.nextPage) {
			$('#nextBtn').removeClass('disabled');
		} else {
			$('#nextBtn').addClass('disabled');
		}
	}

	function escapeHtml(text) {
		const div = document.createElement('div');
		div.textContent = text;
		return div.innerHTML;
	}

	$(document).on('click', function(e) {
		if (!$(e.target).closest('.dropdown').length) {
			$('.dropdown-menu').removeClass('show');
			$('.btn-actions').removeClass('active');
		}
	});

	$(document).on('click', '.btn-actions', function(e) {
		e.preventDefault();
		e.stopPropagation();

		const $button = $(this);
		const $menu = $button.siblings('.dropdown-menu');
		const wasVisible = $menu.hasClass('show');

		$('.dropdown-menu').removeClass('show');
		$('.btn-actions').removeClass('active');

		if (!wasVisible) {
			$menu.addClass('show');
			$button.addClass('active');
		}
	});
</script>
