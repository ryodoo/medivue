<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0">
                        <i class="fa fa-upload text-primary me-2"></i>
                        Import des Produits depuis CSV
                    </h4>
                </div>
                <div class="card-body">

                    <?php echo $this->Session->flash(); ?>

                    <div class="alert alert-info border-0">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>
                            Instructions :
                        </h6>
                        <ul class="mb-0">
                            <li>Le fichier doit être au format CSV avec le séparateur point-virgule (;)</li>
                            <li>Les colonnes attendues : Référence Article,Prix sage (MAD)</li>
                            <li>Les produits existants seront mis à jour, les nouveaux seront ignorés</li>
                        </ul>
                    </div>

                    <?php
                    echo $this->Form->create('Produit', array(
                        'type' => 'file',
                        'class' => 'row g-3',
                        'url' => array('action' => 'import_prix')
                    ));
                    ?>

                    <div class="mb-4">
                        <div class="upload-area border-2 border-dashed rounded-3 p-4 text-center bg-light">
                            <i class="fas fa-cloud-upload-alt text-muted mb-3" style="font-size: 2rem;"></i>
                            <p class="mb-2">Sélectionnez un fichier ou glissez-déposez ici.</p>
                            <p class="text-muted small mb-3">Seuls les fichiers CSV seront acceptés.</p>

                            <?php
                            echo $this->Form->input('csv_file', array(
                                'type' => 'file',
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'accept' => '.csv',
                                'required' => true
                            ));
                            ?>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <?php
                        echo $this->Form->submit('Importer les produits', array(
                            'class' => 'btn btn-primary px-4',
                            'div' => false
                        ));
                        echo $this->Html->link(
                            '<i class="fas fa-list me-2"></i>Retour à la liste',
                            array('action' => 'index'),
                            array('class' => 'btn btn-outline-secondary px-4', 'escape' => false)
                        );
                        echo $this->Html->link(
                            '<i class="fas fa-download me-2"></i>Télécharger un exemple',
                            '/files/exemple_prix.csv',
                            array('class' => 'btn btn-outline-secondary px-4', 'download' => 'exemple_prix.csv', 'escape' => false)
                        );
                        ?>
                    </div>

                    <?php echo $this->Form->end(); ?>

                </div>
            </div>

            <?php if (isset($results) && !empty($results)): ?>
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">Résultats de l'import</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($results as $result): ?>
                            <div class="alert <?php echo $result['type'] == 'added' ? 'alert-success' : 'alert-warning'; ?> border-0 border-start border-4 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?php echo $result['code']; ?></strong> - <?php echo $result['name']; ?>
                                        <?php if (!empty($result['changes'])): ?>
                                            <br><small>Champs modifiés: <?php echo implode(', ', $result['changes']); ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <span class="badge <?php echo $result['type'] == 'added' ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                        <?php echo $result['type'] == 'added' ? 'NOUVEAU' : 'MODIFIÉ'; ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 12px;
    }

    .upload-area {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #0d6efd !important;
        background-color: #f0f8ff !important;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
    }

    .alert {
        border-radius: 8px;
    }

    .badge {
        font-size: 0.75rem;
    }

    .form-control {
        border-radius: 8px;
    }

    .form-label {
        color: #495057;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.querySelector('input[type="file"]');

    // Empêche le comportement par défaut (ouvrir le fichier dans le navigateur)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, e => e.preventDefault());
        uploadArea.addEventListener(eventName, e => e.stopPropagation());
    });

    // Ajoute du style pendant le drag
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('bg-primary-subtle', 'border-primary');
        });
    });

    // Supprime le style quand le drag s'arrête
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('bg-primary-subtle', 'border-primary');
        });
    });

    // Quand un fichier est déposé
    uploadArea.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files; // on assigne les fichiers au champ input
        }
    });

    // Clic sur la zone => clique sur l'input
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });
});
</script>
