<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifier Instrument - Medivue</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: "Poppins", sans-serif;
			font-weight: 300;
			background: #f8fafc;
			height: 100vh;
			display: flex;
			flex-direction: column;
			overflow: hidden;
		}

		/* Progress Bar */
		.progress-container {
			background: white;
			border-bottom: 1px solid #e5e7eb;
			padding: 0.5rem 2rem;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-shrink: 0;
		}

		.progresses {
			display: flex;
			align-items: center;
			gap: 0;
			position: relative;
		}

		.step-wrapper {
			display: flex;
			align-items: center;
			position: relative;
			z-index: 2;
		}

		.line {
			height: 3px;
			background: #e5e7eb;
			transition: background 0.4s ease;
			flex: 1;
			min-width: 80px;
			position: relative;
			z-index: 1;
		}

		.line.active {
			background: #63d19e;
		}

		.steps {
			display: flex;
			background-color: #63d19e;
			color: #fff;
			font-size: 0.75rem;
			font-weight: 500;
			height: 38px;
			padding: 0 1.25rem;
			align-items: center;
			justify-content: center;
			border-radius: 50px;
			transition: all 0.4s ease;
			white-space: nowrap;
			box-shadow: 0 2px 8px rgba(99, 209, 158, 0.3);
			position: relative;
		}

		.steps.inactive {
			background-color: #e5e7eb;
			color: #94a3b8;
			box-shadow: none;
		}

		.steps.completed {
			background-color: #63d19e;
			color: #fff;
			box-shadow: 0 2px 8px rgba(99, 209, 158, 0.2);
		}

		/* Main Content */
		.container {
			max-width: 100%;
			margin: 0 auto;
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
			padding: 0;
			width: 100%;
			overflow: hidden;
			min-height: 0;
		}

		.page-content {
			display: none;
			flex-direction: column;
			align-items: center;
			text-align: center;
			width: 100%;
			max-width: 700px;
			margin: 0 auto;
			padding: 1.5rem 2rem;
			height: 100%;
			overflow: hidden;
			position: relative;
			flex: 1;
			min-height: 0;
		}

		.page-content.active {
			display: flex;
		}

		/* Page 2 Specific Styles */
		#page2 {
			max-width: 100%;
			background: transparent;
			padding: 1.5rem 2rem;
			border-radius: 0;
			box-shadow: none;
			margin: 0;
			height: auto;
			overflow-y: auto;
			display: none;
			align-items: flex-start;
			justify-content: flex-start;
			flex: 1;
			min-height: 0;
		}

		#page2.active {
			display: flex;
		}

		.form-content-wrapper {
			display: flex;
			flex-direction: row;
			gap: 2.5rem;
			width: 100%;
			max-width: 1800px;
			margin: 0 auto;
			min-height: fit-content;
			align-items: start;
			background: white;
			padding: 2rem;
			border-radius: 12px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
		}

		.photo-section {
			display: flex;
			flex-direction: column;
			gap: 1rem;
			width: 200px;
			flex-shrink: 0;
		}

		.photo-section-title {
			font-size: 0.9rem;
			font-weight: 600;
			color: #1a202c;
			text-align: center;
		}

		.photo-capture-area {
			position: relative;
			width: 100%;
			height: 200px;
			border: 2px dashed #cbd5e1;
			border-radius: 12px;
			background: #f8fafc;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			overflow: hidden;
			transition: all 0.3s ease;
		}

		.photo-capture-area:hover {
			border-color: #10b981;
			background: #f0fdf4;
		}

		.photo-preview {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: none;
		}

		.photo-preview.active {
			display: block;
		}

		.photo-placeholder {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			gap: 1rem;
		}

		.photo-placeholder.hidden {
			display: none;
		}

		.photo-placeholder svg {
			width: 40px;
			height: 40px;
			color: #cbd5e1;
		}

		.photo-placeholder-text {
			color: #94a3b8;
			font-size: 0.75rem;
			font-weight: 500;
		}

		.change-photo-btn {
			position: absolute;
			bottom: 0.65rem;
			right: 0.65rem;
			background: white;
			color: #64748b;
			border: none;
			padding: 0.6rem;
			border-radius: 50%;
			width: 36px;
			height: 36px;
			display: none;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			transition: all 0.2s;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
			outline: none;
		}

		.change-photo-btn.active {
			display: flex;
		}

		.change-photo-btn:hover {
			background: #f8fafc;
			color: #10b981;
			transform: scale(1.08);
		}

		.change-photo-btn:active {
			background: white;
			color: #64748b;
		}

		.change-photo-btn svg {
			width: 15px;
			height: 15px;
			stroke: currentColor;
			fill: none;
			stroke-width: 2;
			stroke-linecap: round;
			stroke-linejoin: round;
		}

		.form-section {
			flex: 1;
			text-align: left;
			display: flex;
			flex-direction: column;
			overflow: visible;
			min-height: fit-content;
		}

		.form-checkbox {
			display: flex;
			align-items: center;
			gap: 0.65rem;
			margin-bottom: 1.25rem;
			padding: 0;
			background: transparent;
			border-radius: 0;
			flex-shrink: 0;
		}

		.form-checkbox input[type="checkbox"] {
			width: 18px;
			height: 18px;
			cursor: pointer;
			accent-color: #10b981;
		}

		.form-checkbox label {
			font-size: 0.9rem;
			color: #1a202c;
			font-weight: 500;
			cursor: pointer;
			margin: 0;
		}

		.form-grid {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 1.25rem 2rem;
			align-content: start;
			overflow: visible;
		}

		.form-field {
			display: flex;
			flex-direction: column;
			min-height: 0;
			position: relative;
		}

		.form-field.full-width {
			grid-column: 1 / -1;
		}

		.form-label {
			font-size: 0.825rem;
			font-weight: 600;
			color: #475569;
			margin-bottom: 0.45rem;
		}

		.form-input {
			width: 100%;
			padding: 0.7rem 1rem;
			border: 1.5px solid #e5e7eb;
			border-radius: 8px;
			font-size: 0.875rem;
			background: white;
			color: #1a202c;
			transition: all 0.2s;
		}

		.form-input:focus {
			outline: none;
			border-color: #10b981;
			background: #f8fafc;
			box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
		}

		.form-textarea {
			min-height: 80px;
			max-height: 120px;
			resize: vertical;
		}

		/* Autocomplete Dropdown */
		.autocomplete-dropdown {
			position: absolute;
			top: 100%;
			left: 0;
			right: 0;
			background: white;
			border: 1.5px solid #e5e7eb;
			border-top: none;
			border-radius: 0 0 10px 10px;
			max-height: 200px;
			overflow-y: auto;
			display: none;
			z-index: 1000;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			margin-top: -1px;
		}

		.autocomplete-dropdown.active {
			display: block;
		}

		.autocomplete-item {
			padding: 0.85rem 1.25rem;
			cursor: pointer;
			font-size: 0.95rem;
			color: #1a202c;
			transition: background 0.15s;
		}

		.autocomplete-item:hover {
			background: #f8fafc;
		}

		.autocomplete-item.selected {
			background: #dcfce7;
		}

		.autocomplete-item:last-child {
			border-radius: 0 0 8px 8px;
		}

		.scan-icon-container {
			width: 120px;
			height: 120px;
			margin-bottom: 0.75rem;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-shrink: 0;
		}

		.scan-icon-container img {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}

		.scan-icon-container svg {
			width: 100%;
			height: 100%;
			color: #2563eb;
		}

		.scan-title {
			font-size: 1.25rem;
			font-weight: 600;
			color: #1a202c;
			margin-bottom: 0.35rem;
		}

		.scan-description {
			font-size: 0.875rem;
			color: #64748b;
			margin-bottom: 1rem;
		}

		.input-container {
			width: 100%;
			max-width: 500px;
			margin-bottom: 0.75rem;
			flex-shrink: 0;
		}

		.badge-input {
			width: 100%;
			padding: 0.875rem 1.25rem;
			font-size: 0.95rem;
			border: 1.5px solid #e5e7eb;
			border-radius: 8px;
			background: white;
			color: #1a202c;
			transition: all 0.2s ease;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
		}

		.badge-input:focus {
			outline: none;
			border-color: #2563eb;
			box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
		}

		.badge-input::placeholder {
			color: #94a3b8;
		}

		/* Bottom Section */
		.bottom-section {
			background: white;
			border-top: 1px solid #e5e7eb;
			padding: 0.85rem 4rem;
			display: flex;
			justify-content: space-between;
			align-items: center;
			position: relative;
			flex-shrink: 0;
		}

		.back-button, .next-button {
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
			padding: 0.65rem 1.5rem;
			border: 1.5px solid #e5e7eb;
			border-radius: 8px;
			font-size: 0.9rem;
			font-weight: 500;
			cursor: pointer;
			transition: all 0.2s ease;
			background: white;
			box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
		}

		.back-button {
			color: #64748b;
		}

		.back-button:hover {
			background: #f8fafc;
			border-color: #cbd5e1;
			color: #475569;
		}

		.next-button {
			background: #10b981;
			color: white;
			border-color: #10b981;
		}

		.next-button:hover {
			background: #059669;
			border-color: #059669;
		}

		.next-button:disabled {
			background: #e5e7eb;
			border-color: #e5e7eb;
			color: #94a3b8;
			cursor: not-allowed;
		}

		.back-button svg, .next-button svg {
			width: 16px;
			height: 16px;
			stroke: currentColor;
			fill: none;
			stroke-width: 2;
			stroke-linecap: round;
			stroke-linejoin: round;
		}
		.back-button:focus, .next-button:focus {
			outline: none;
		}

		.back-button:active, .next-button:active {
			outline: none;
		}

		.help-text {
			position: absolute;
			left: 50%;
			transform: translateX(-50%);
			color: #94a3b8;
			font-size: 0.85rem;
		}

		/* Notification Toast System */
		.notification-container {
			position: fixed;
			top: 6rem;
			right: 2rem;
			z-index: 1000;
			max-height: 80vh;
			overflow: visible;
			pointer-events: none;
		}

		.notification-container * {
			pointer-events: auto;
		}

		.notification-stack {
			position: relative;
			width: 360px;
		}

		.notification {
			background: white;
			border-radius: 10px;
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
			padding: 1rem 1.25rem;
			position: absolute;
			width: 100%;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}

		.notification:nth-child(1) {
			transform: translateY(0) scale(1);
			z-index: 3;
			opacity: 1;
		}

		.notification:nth-child(2) {
			transform: translateY(-8px) scale(0.95);
			z-index: 2;
			opacity: 0.7;
		}

		.notification:nth-child(3) {
			transform: translateY(-16px) scale(0.9);
			z-index: 1;
			opacity: 0.4;
		}

		.notification:nth-child(n+4) {
			display: none;
		}

		.notification-header {
			display: flex;
			align-items: flex-start;
			gap: 0.625rem;
			margin-bottom: 0;
		}

		.notification-icon-wrapper {
			width: 36px;
			height: 36px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-shrink: 0;
		}

		.notification.success .notification-icon-wrapper {
			background: #dcfce7;
		}

		.notification.error .notification-icon-wrapper {
			background: #fee2e2;
		}

		.notification.info .notification-icon-wrapper {
			background: #dbeafe;
		}

		.notification-icon {
			width: 20px;
			height: 20px;
		}

		.notification.success .notification-icon {
			color: #16a34a;
		}

		.notification.error .notification-icon {
			color: #dc2626;
		}

		.notification.info .notification-icon {
			color: #2563eb;
		}

		.notification-content {
			flex: 1;
		}

		.notification-title {
			font-weight: 600;
			font-size: 0.9rem;
			color: #0f172a;
			margin-bottom: 0.15rem;
		}

		.notification-message {
			font-size: 0.8rem;
			color: #64748b;
			line-height: 1.4;
		}

		@keyframes slideInNotification {
			from {
				transform: translateX(450px);
				opacity: 0;
			}
			to {
				transform: translateX(0);
				opacity: 1;
			}
		}

		.notification.entering {
			animation: slideInNotification 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		}

		/* Responsive adjustments */
		@media (max-width: 1400px) {
			#page2 {
				padding: 1.25rem 1.5rem;
			}

			.form-content-wrapper {
				gap: 2rem;
				padding: 1.75rem;
			}

			.photo-section {
				width: 180px;
			}

			.photo-capture-area {
				height: 180px;
			}
		}

		@media (max-width: 1200px) {
			#page2 {
				padding: 1rem 1.25rem;
			}

			.form-grid {
				grid-template-columns: repeat(2, 1fr);
			}

			.photo-section {
				width: 160px;
			}

			.photo-capture-area {
				height: 160px;
			}

			.form-content-wrapper {
				gap: 1.5rem;
				padding: 1.5rem;
			}

			.form-input {
				padding: 0.65rem 0.9rem;
				font-size: 0.85rem;
			}

			.form-label {
				font-size: 0.8rem;
			}
		}

		@media (max-width: 900px) {
			#page2 {
				padding: 1rem;
			}

			.form-content-wrapper {
				gap: 1.25rem;
				padding: 1.25rem;
			}

			.photo-section {
				width: 140px;
			}

			.photo-capture-area {
				height: 140px;
			}

			.form-grid {
				gap: 1rem 1.5rem;
			}

			.form-input {
				padding: 0.6rem 0.85rem;
				font-size: 0.8rem;
			}

			.form-label {
				font-size: 0.75rem;
				margin-bottom: 0.35rem;
			}

			.form-textarea {
				min-height: 70px;
			}
		}

		@media (max-width: 768px) {
			.progress-container {
				padding: 0.5rem 1rem;
			}

			.progresses {
				width: 100%;
			}

			.line {
				min-width: 40px;
			}

			.steps {
				font-size: 0.65rem;
				padding: 0 0.85rem;
				height: 32px;
			}

			.container {
				padding: 0;
			}

			#page2 {
				padding: 1rem;
			}

			.form-content-wrapper {
				flex-direction: column;
				gap: 1.5rem;
			}

			.photo-section {
				width: 100%;
			}

			.photo-capture-area {
				height: 200px;
			}

			.form-grid {
				grid-template-columns: 1fr;
				gap: 1.25rem;
			}

			.bottom-section {
				padding: 1rem;
				flex-wrap: wrap;
				gap: 0.5rem;
			}

			.help-text {
				position: static;
				transform: none;
				margin: 0.5rem 0;
				order: 3;
				width: 100%;
			}

			.notification-container {
				right: 1rem;
				left: 1rem;
			}

			.notification-stack {
				width: 100%;
			}
		}
	</style>
</head>
<body>
<!-- Progress Bar -->
<div class="progress-container">
	<div class="progresses">
		<div class="step-wrapper" id="stepWrapper1">
			<div class="steps" id="step1">Authentification</div>
		</div>
		<span class="line" id="line1"></span>
		<div class="step-wrapper" id="stepWrapper2">
			<div class="steps inactive" id="step2">Formulaire</div>
		</div>
		<span class="line" id="line2"></span>
		<div class="step-wrapper" id="stepWrapper3">
			<div class="steps inactive" id="step3">Finalisation</div>
		</div>
	</div>
</div>

<!-- Main Content -->
<div class="container">
	<!-- Page 1: Authentification -->
	<div class="page-content active" id="page1">
		<div class="scan-icon-container">
			<img src="/img/scanlogo.png" alt="Scanner">
		</div>

		<h1 class="scan-title">Authentification</h1>
		<p class="scan-description">Veuillez scanner votre badge pour accéder au système</p>

		<div class="input-container">
			<input
				type="text"
				class="badge-input"
				placeholder="Scanner ou saisir votre badge (code: 0)"
				id="badgeInput"
				autofocus
			>
		</div>
	</div>

	<!-- Page 2: Photo et Formulaire -->
	<div class="page-content" id="page2">
		<form id="instrumentForm" method="post" enctype="multipart/form-data" style="width: 100%;">
			<input type="hidden" name="data[Instrument][id]" value="<?php echo $this->request->data['Instrument']['id']; ?>">
			<div class="form-content-wrapper">
				<div class="photo-section">
					<div class="photo-section-title">Photo de l'instrument</div>
					<div class="photo-capture-area" id="photoCaptureArea">
						<input type="file" accept="image/*" id="photoInput" name="data[Instrument][image_file]" style="display: none;">
						<img id="photoPreview" class="photo-preview" alt="Photo de l'instrument">
						<div class="photo-placeholder" id="photoPlaceholder">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
								<circle cx="8.5" cy="8.5" r="1.5"/>
								<polyline points="21 15 16 10 5 21"/>
							</svg>
							<div class="photo-placeholder-text">Cliquer pour capturer</div>
						</div>
						<button type="button" class="change-photo-btn" id="changePhotoBtn">
							<svg viewBox="0 0 24 24">
								<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
								<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
							</svg>
						</button>
					</div>
				</div>

				<div class="form-section">
					<div class="form-checkbox">
						<input type="checkbox" id="instrumentSansCode" name="data[Instrument][sans_code]" <?php echo !empty($this->request->data['Instrument']['sans_code']) ? 'checked' : ''; ?>>
						<label for="instrumentSansCode">Instrument sans code</label>
					</div>
					<div class="form-grid">
						<div class="form-field">
							<label class="form-label">Code</label>
							<input type="text" class="form-input" id="code" name="data[Instrument][code]" value="<?php echo h($this->request->data['Instrument']['code']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Référence</label>
							<input type="text" class="form-input" id="ref" name="data[Instrument][ref]" value="<?php echo h($this->request->data['Instrument']['ref']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Nom</label>
							<input type="text" class="form-input" id="name" name="data[Instrument][name]" value="<?php echo h($this->request->data['Instrument']['name']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Nom commercial</label>
							<input type="text" class="form-input" id="nomCommercial" name="data[Instrument][nom_comercial]" value="<?php echo h($this->request->data['Instrument']['nom_comercial']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Fournisseur</label>
							<input type="text" class="form-input" id="fournisseurName" autocomplete="off" placeholder="Rechercher un fournisseur..." value="<?php echo h($this->request->data['Fournisseur']['name']); ?>">
							<input type="hidden" id="fournisseurId" name="data[Instrument][fournisseur_id]" value="<?php echo h($this->request->data['Instrument']['fournisseur_id']); ?>">
							<div class="autocomplete-dropdown" id="fournisseurDropdown"></div>
						</div>
						<div class="form-field">
							<label class="form-label">Code fournisseur</label>
							<input type="text" class="form-input" id="codeFournisseur" name="data[Instrument][code_fournisseur]" value="<?php echo h($this->request->data['Instrument']['code_fournisseur']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Taille</label>
							<input type="text" class="form-input" id="taille" name="data[Instrument][taille]" value="<?php echo h($this->request->data['Instrument']['taille']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Prix</label>
							<input type="text" class="form-input" id="prix" name="data[Instrument][prix]" value="<?php echo h($this->request->data['Instrument']['prix']); ?>">
						</div>
						<div class="form-field">
							<label class="form-label">Numéro de lot</label>
							<input type="text" class="form-input" id="numLot" name="data[Instrument][num_lot]" value="<?php echo h($this->request->data['Instrument']['num_lot']); ?>">
						</div>
						<div class="form-field full-width">
							<label class="form-label">Remarque</label>
							<textarea class="form-input form-textarea" id="remarque" name="data[Instrument][remarque]"><?php echo h($this->request->data['Instrument']['remarque']); ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- Page 3: Finalisation -->
	<div class="page-content" id="page3">
		<div class="scan-icon-container">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
				<circle cx="12" cy="12" r="10"/>
				<path d="M9 12l2 2 4-4"/>
			</svg>
		</div>

		<h1 class="scan-title">Finalisation</h1>
		<p class="scan-description">Modifications enregistrées avec succès!</p>
	</div>
</div>

<!-- Bottom Section -->
<div class="bottom-section">
	<button type="button" class="back-button" id="backButton">
		<svg viewBox="0 0 24 24">
			<polyline points="15 18 9 12 15 6"/>
		</svg>
		Retour
	</button>
	<div class="help-text" id="helpText">
		Scannez votre badge pour continuer
	</div>
	<button type="button" class="next-button" id="nextButton" disabled>
		Suivant
		<svg viewBox="0 0 24 24">
			<polyline points="9 18 15 12 9 6"/>
		</svg>
	</button>
</div>

<!-- Notification Container -->
<div class="notification-container">
	<div class="notification-stack" id="notificationStack"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	let currentStep = 1;
	let fournisseursData = [];
	const isEditMode = true;
	const instrumentId = <?php echo $this->request->data['Instrument']['id']; ?>;

	const baseUrl = window.location.origin;

	const badgeInput = document.getElementById('badgeInput');
	const nextButton = document.getElementById('nextButton');
	const backButton = document.getElementById('backButton');
	const helpText = document.getElementById('helpText');
	const photoInput = document.getElementById('photoInput');
	const photoPreview = document.getElementById('photoPreview');
	const instrumentForm = document.getElementById('instrumentForm');

	const fournisseurNameInput = document.getElementById('fournisseurName');
	const fournisseurIdInput = document.getElementById('fournisseurId');
	const fournisseurDropdown = document.getElementById('fournisseurDropdown');

	// Load existing image if available
	<?php if (!empty($this->request->data['Instrument']['image'])): ?>
	photoPreview.src = '<?php echo $this->webroot . $this->request->data['Instrument']['image']; ?>';
	photoPreview.classList.add('active');
	document.getElementById('photoPlaceholder').classList.add('hidden');
	document.getElementById('changePhotoBtn').classList.add('active');
	<?php endif; ?>

	function showNotification(type, title, message) {
		const stack = document.getElementById('notificationStack');
		const notification = document.createElement('div');
		notification.className = `notification ${type} entering`;

		const icons = {
			success: '<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>',
			error: '<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>',
			info: '<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
		};

		notification.innerHTML = `
			<div class="notification-header">
				<div class="notification-icon-wrapper">
					${icons[type]}
				</div>
				<div class="notification-content">
					<div class="notification-title">${title}</div>
					<div class="notification-message">${message}</div>
				</div>
			</div>
		`;

		stack.insertBefore(notification, stack.firstChild);
		setTimeout(() => notification.classList.remove('entering'), 400);

		setTimeout(() => {
			notification.style.opacity = '0';
			notification.style.transform = 'translateX(450px)';
			setTimeout(() => notification.remove(), 300);
		}, 4000);

		const notifications = stack.querySelectorAll('.notification');
		if (notifications.length > 3) {
			notifications[notifications.length - 1].remove();
		}
	}

	function loadFournisseurs() {
		$.ajax({
			url: baseUrl + '/instruments/getFournisseurs',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				fournisseursData = data;
				console.log('Fournisseurs loaded:', fournisseursData);
			},
			error: function(xhr, status, error) {
				console.error('Error loading fournisseurs:', error);
				showNotification('error', 'Erreur', 'Impossible de charger les fournisseurs');
			}
		});
	}

	$(document).ready(function() {
		loadFournisseurs();
	});

	fournisseurNameInput.addEventListener('input', function() {
		const searchTerm = this.value.toLowerCase().trim();

		console.log('Search term:', searchTerm);
		console.log('Fournisseurs data:', fournisseursData);

		// Don't clear the hidden ID if user is just editing the name
		// fournisseurIdInput.value = '';

		if (searchTerm.length === 0) {
			fournisseurDropdown.classList.remove('active');
			return;
		}

		if (!fournisseursData || fournisseursData.length === 0) {
			console.log('No fournisseurs data available');
			fournisseurDropdown.innerHTML = '<div class="autocomplete-item" style="pointer-events: none; color: #94a3b8;">Aucun fournisseur trouvé</div>';
			fournisseurDropdown.classList.add('active');
			return;
		}

		const filtered = fournisseursData.filter(f =>
			f.name.toLowerCase().includes(searchTerm)
		);

		console.log('Filtered results:', filtered);

		if (filtered.length > 0) {
			fournisseurDropdown.innerHTML = filtered.map(f =>
				`<div class="autocomplete-item" data-id="${f.id}" data-name="${f.name}">${f.name}</div>`
			).join('');
			fournisseurDropdown.classList.add('active');
		} else {
			fournisseurDropdown.innerHTML = '<div class="autocomplete-item" style="pointer-events: none; color: #94a3b8;">Aucun résultat</div>';
			fournisseurDropdown.classList.add('active');
		}
	});

	fournisseurDropdown.addEventListener('click', function(e) {
		if (e.target.classList.contains('autocomplete-item')) {
			const id = e.target.getAttribute('data-id');
			const name = e.target.getAttribute('data-name');

			fournisseurNameInput.value = name;
			fournisseurIdInput.value = id;
			fournisseurDropdown.classList.remove('active');
		}
	});

	document.addEventListener('click', function(e) {
		if (!fournisseurNameInput.contains(e.target) && !fournisseurDropdown.contains(e.target)) {
			fournisseurDropdown.classList.remove('active');
		}
	});

	let selectedIndex = -1;
	fournisseurNameInput.addEventListener('keydown', function(e) {
		const items = fournisseurDropdown.querySelectorAll('.autocomplete-item');

		if (e.key === 'ArrowDown') {
			e.preventDefault();
			selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
			updateSelection(items);
		} else if (e.key === 'ArrowUp') {
			e.preventDefault();
			selectedIndex = Math.max(selectedIndex - 1, 0);
			updateSelection(items);
		} else if (e.key === 'Enter' && selectedIndex >= 0) {
			e.preventDefault();
			items[selectedIndex].click();
			selectedIndex = -1;
		}
	});

	function updateSelection(items) {
		items.forEach((item, index) => {
			item.classList.toggle('selected', index === selectedIndex);
		});
		if (items[selectedIndex]) {
			items[selectedIndex].scrollIntoView({ block: 'nearest' });
		}
	}

	function updateProgress() {
		const steps = [
			document.getElementById('step1'),
			document.getElementById('step2'),
			document.getElementById('step3')
		];
		const lines = [
			document.getElementById('line1'),
			document.getElementById('line2')
		];

		steps.forEach((step, index) => {
			step.classList.remove('inactive', 'completed');
			if (index < currentStep - 1) {
				step.classList.add('completed');
			} else if (index === currentStep - 1) {
				// Current active step
			} else {
				step.classList.add('inactive');
			}
		});

		lines.forEach((line, index) => {
			line.classList.remove('active');
			if (index < currentStep - 1) {
				line.classList.add('active');
			}
		});
	}

	const photoCaptureArea = document.getElementById('photoCaptureArea');
	const photoPlaceholder = document.getElementById('photoPlaceholder');
	const changePhotoBtn = document.getElementById('changePhotoBtn');

	photoCaptureArea.addEventListener('click', function(e) {
		if (e.target !== changePhotoBtn && !changePhotoBtn.contains(e.target)) {
			photoInput.click();
		}
	});

	changePhotoBtn.addEventListener('click', function(e) {
		e.stopPropagation();
		photoInput.click();
	});

	photoInput.addEventListener('change', function(e) {
		const file = e.target.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(event) {
				photoPreview.src = event.target.result;
				photoPreview.classList.add('active');
				photoPlaceholder.classList.add('hidden');
				changePhotoBtn.classList.add('active');
				checkInputs();
			};
			reader.readAsDataURL(file);
		}
	});

	function checkInputs() {
		if (currentStep === 1) {
			nextButton.disabled = badgeInput.value.trim().length === 0;
		} else if (currentStep === 2) {
			const hasPhoto = photoPreview.classList.contains('active');

			const code = document.getElementById('code').value.trim();
			const ref = document.getElementById('ref').value.trim();
			const name = document.getElementById('name').value.trim();
			const nomCommercial = document.getElementById('nomCommercial').value.trim();
			const fournisseurName = document.getElementById('fournisseurName').value.trim();
			const codeFournisseur = document.getElementById('codeFournisseur').value.trim();
			const taille = document.getElementById('taille').value.trim();
			const prix = document.getElementById('prix').value.trim();
			const numLot = document.getElementById('numLot').value.trim();

			const allFieldsFilled = code && ref && name && nomCommercial && fournisseurName && codeFournisseur && taille && prix && numLot;

			nextButton.disabled = !(hasPhoto && allFieldsFilled);
		} else if (currentStep === 3) {
			nextButton.disabled = false;
			nextButton.innerHTML = 'Enregistrer <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
		}
	}

	badgeInput.addEventListener('input', function() {
		checkInputs();
	});

	const formInputs = [
		document.getElementById('code'),
		document.getElementById('ref'),
		document.getElementById('name'),
		document.getElementById('nomCommercial'),
		document.getElementById('fournisseurName'),
		document.getElementById('codeFournisseur'),
		document.getElementById('taille'),
		document.getElementById('prix'),
		document.getElementById('numLot')
	];

	formInputs.forEach(input => {
		input.addEventListener('input', function() {
			if (currentStep === 2) {
				checkInputs();
			}
		});
	});

	fournisseurDropdown.addEventListener('click', function(e) {
		if (e.target.classList.contains('autocomplete-item')) {
			setTimeout(() => {
				if (currentStep === 2) {
					checkInputs();
				}
			}, 100);
		}
	});

	badgeInput.addEventListener('keypress', function(e) {
		if (e.key === 'Enter' && this.value.trim().length > 0) {
			if (this.value.trim() === '0') {
				showNotification('success', 'Authentification réussie', 'Badge validé avec succès');
				this.disabled = true;
				nextButton.disabled = true;
				setTimeout(() => {
					if (currentStep === 1) {
						currentStep++;
						updateProgress();
						showPage(currentStep);
						this.disabled = false;
					}
				}, 2000);
			} else {
				showNotification('error', 'Badge invalide', 'Code badge incorrect. Le code correct est: 0');
				this.value = '';
			}
		}
	});

	nextButton.addEventListener('click', function() {
		if (currentStep === 1 && badgeInput.value.trim() !== '0') {
			showNotification('error', 'Vérification requise', 'Veuillez saisir le code badge correct (0)');
			badgeInput.value = '';
			checkInputs();
			return;
		}

		if (!this.disabled && currentStep < 3) {
			if (currentStep === 1 && badgeInput.value.trim() === '0') {
				showNotification('success', 'Authentification réussie', 'Badge validé avec succès');
				badgeInput.disabled = true;
				nextButton.disabled = true;
				setTimeout(() => {
					currentStep++;
					updateProgress();
					showPage(currentStep);
					badgeInput.disabled = false;
					if (fournisseursData.length === 0) {
						loadFournisseurs();
					}
				}, 2000);
				return;
			}

			if (currentStep === 2) {
				currentStep++;
				updateProgress();
				showPage(currentStep);
				return;
			}
		}

		if (currentStep === 3 && !this.disabled) {
			submitForm();
		}
	});

	function submitForm() {
		const formData = new FormData(instrumentForm);

		nextButton.disabled = true;
		nextButton.innerHTML = 'Envoi en cours... <svg viewBox="0 0 24 24" class="animate-spin"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" opacity="0.75"/></svg>';

		$.ajax({
			url: baseUrl + '/instruments/edit/' + instrumentId,
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				showNotification('success', 'Succès', 'Instrument modifié avec succès');

				// Redirect to index page after successful update
				setTimeout(() => {
					window.location.href = baseUrl + '/instruments/index';
				}, 2000);
			},
			error: function(xhr, status, error) {
				showNotification('error', 'Erreur', 'Impossible de modifier l\'instrument');
				nextButton.disabled = false;
				nextButton.innerHTML = 'Enregistrer <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
			}
		});
	}

	backButton.addEventListener('click', function() {
		if (currentStep === 1) {
			// Redirect to index page when clicking back on step 1
			showNotification('info', 'Retour', 'Retour à la page d\'accueil');
			setTimeout(() => {
				window.location.href = baseUrl + '/instruments/index';
			}, 1000);
		} else if (currentStep > 1) {
			currentStep--;
			updateProgress();
			showPage(currentStep);
			showNotification('info', 'Retour', `Retour à l'étape ${currentStep}`);
		}
	});

	function showPage(pageNumber) {
		document.querySelectorAll('.page-content').forEach(page => {
			page.classList.remove('active');
		});
		document.getElementById('page' + pageNumber).classList.add('active');

		const helpTexts = {
			1: 'Scannez votre badge pour continuer',
			2: 'Modifiez les informations et la photo si nécessaire',
			3: 'Cliquez sur Enregistrer pour sauvegarder les modifications'
		};
		helpText.textContent = helpTexts[pageNumber] || '';

		if (pageNumber === 1) {
			badgeInput.value = '';
			badgeInput.focus();
			nextButton.innerHTML = 'Suivant <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>';
		} else if (pageNumber === 2) {
			nextButton.innerHTML = 'Suivant <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>';
		}

		checkInputs();
	}

	updateProgress();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
