<?php
echo $this->Html->css('daterangepicker');
echo $this->Html->css('select2.min');
echo $this->Html->css('dataTables.bootstrap');
echo $this->Html->css('_all-skins.min');
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('select2.full.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('app.min');
echo $this->Html->script('jquery.dataTables.min');
echo $this->Html->script('jquery.slimscroll.min');
echo $this->Html->script('fastclick');
echo $this->Html->script('demo');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<style>
    .box-body {
        overflow: hidden;
        overflow-y: hidden;
    }

    .dt-button {
        width: auto;
        float: left;
        margin: 5px;
        font-size: 16px;
        line-height: 22px;
        padding: 3px 8px;
        background: #337ab7;
        color: #fff;
    }

    .dt-button:hover {
        color: #fff;
        background: #1a486f;
    }
</style>
<div class="row">
    <div class="col-xs-12" style="margin-bottom: 24px;">

        <div class="box form-group">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                <form action="<?php echo $this->Html->url("/analyses/moyenne_visites") ?>" method="post" id="dateform"
                    autocomplete="off">
                    <div class="input-group col-lg-10 col-md-10 col-xs-12" style="float:right;margin-bottom:30px;">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" value="<?php echo h($dateaafficherdansleview); ?>" name="date" id="reservationtime" placeholder="Rechercher">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('category', array(
                            "label" => "Choisissez l'activté",
                            "name" => "activite",
                            'options' => array("" => "Choisissez", "prive" => "Privé", "Publique" => "Publique"),
                            'class' => 'form-control pull-right'
                        ));
                        echo $this->Form->input('potentialite', array(
                            "multiple" => "true",
                            "label" => "Choisissez potentialité",
                            "name" => "potentialite",
                            'options' => array(
                                "A1" => "A1",
                                "A2" => "A2",
                                "A3" => "A3",
                                "B1" => "B1",
                                "B2" => "B2",
                                "B3" => "B3",
                                "C1" => "C1",
                                "C2" => "C2",
                                "C3" => "C3"
                            ),
                            'class' => 'form-control pull-right choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        if (AuthComponent::user('role') != 'Super viseur')
                            echo $this->Form->input('category', array(
                                "multiple" => "true",
                                "label" => "La liste des secteurs",
                                "name" => "secteur",
                                'options' => $secteurs,
                                'class' => 'form-control pull-right choix_multi select2',
                                'multiple' => 'multiple'
                            ));

                        echo $this->Form->input('category', array(
                            "multiple" => "true",
                            "label" => "La liste des spécialité",
                            "name" => "category",
                            'options' => $categories,
                            'class' => 'form-control pull-right choix_multi select2',
                            'multiple' => 'multiple'
                        ));
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        echo $this->Form->input('user', array(
                            "multiple" => "true",
                            "label" => "La liste des VM",
                            "name" => "users",
                            'options' => $allusers,
                            'class' => 'form-control pull-right choix_multi vm select2',
                            'multiple' => 'multiple'
                        ));
                        echo $this->Form->input('ligne', array(
                            "multiple" => "true",
                            "label" => "Les lignes",
                            "name" => "ligne",
                            'options' => $lignes,
                            'class' => 'form-control pull-right choix_multi vm select2',
                            'multiple' => 'multiple'
                        ));
                        $types = array("1" => "Medcin", "2" => "Pharmacie", );
                        echo $this->Form->input('type', array(
                            "multiple" => "true",
                            "label" => "Type de client",
                            "name" => "type",
                            'options' => $types,
                            'class' => 'form-control pull-right choix_multi vm select2',
                            'multiple' => 'multiple'
                        ));
                        ?>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Rechercher"
                            style="float: right;-webkit-appearance:  none;background: #367fa9;border: none;border-radius: 3px;color: #fff;padding: 3px 5px;box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.52);">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vue CakePHP 2 pour affichage des statistiques -->
<?php
// Traitement des données côté PHP UNIQUEMENT
$regions_data = array();
$regions_data_global = array();
$regions_labels = array();
if (isset($data_moyenne['par_region'])) {
    foreach ($data_moyenne['par_region'] as $region => $data) {
        if ($region !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $regions_labels[] = $region;
            $regions_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $regions_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$lignes_data = array();
$lignes_data_global = array();
$lignes_labels = array();
if (isset($data_moyenne['par_ligne'])) {
    foreach ($data_moyenne['par_ligne'] as $ligne => $data) {
        if ($ligne !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $lignes_labels[] = 'Ligne ' . $ligne;
            $lignes_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $lignes_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}
$vm_data = array();
$vm_data_global = array();
$vm_labels = array();
if (isset($data_moyenne['par_vm'])) {
    foreach ($data_moyenne['par_vm'] as $vm => $data) {
        if ($vm !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $vm_labels[] = $tout_user_pour_affchage_dans_le_view[$vm];
            $vm_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $vm_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$supers_data = array();
$supers_data_global = array();
$supers_labels = array();
if (isset($data_moyenne['par_super'])) {
    foreach ($data_moyenne['par_super'] as $super => $data) {
        if ($super !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $supers_labels[] = $tout_user_pour_affchage_dans_le_view[$super];
            $supers_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $supers_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$mois_data = array();
$mois_data_global = array();
$mois_labels = array();
if (isset($data_moyenne['par_mois'])) {
    foreach ($data_moyenne['par_mois'] as $mois => $data) {
        if ($mois !== '_moyenne_globale' && isset($data['_moyenne_groupe'])) {
            $mois_labels[] = $mois;
            $mois_data[] = (float) $data['_moyenne_groupe']['moyenne_visite_par_jour'];
            $mois_data_global[] =  $data['_moyenne_groupe']['moyenne_visite_objectif'];
        }
    }
}

$moyenne_globale_region = isset($data_moyenne['par_region']['_moyenne_globale']) ? (float) $data_moyenne['par_region']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_ligne = isset($data_moyenne['par_ligne']['_moyenne_globale']) ? (float) $data_moyenne['par_ligne']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_super = isset($data_moyenne['par_super']['_moyenne_globale']) ? (float) $data_moyenne['par_super']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_mois = isset($data_moyenne['par_mois']['_moyenne_globale']) ? (float) $data_moyenne['par_mois']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
$moyenne_globale_vm = isset($data_moyenne['par_vm']['_moyenne_globale']) ? (float) $data_moyenne['par_vm']['_moyenne_globale']['moyenne_visite_par_jour'] : 0;
?>
<div class="clearfix"></div>
<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Moyenne par Région</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartRegion', 'region.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartRegion" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneRegion">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableRegion" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Ligne -->
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-line-chart"></i> Moyenne par Ligne</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartLigne', 'ligne.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartLigne" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneLigne">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableLigne" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Graphique par Superviseur -->
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i> Moyenne par Superviseur</h3>
                <button class="btn btn-xs btn-default pull-right"
                    onclick="downloadChart('chartSuper', 'superviseur.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartSuper" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneSuper">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableSuper" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Mois -->
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fa fa-calendar"></i> Moyenne par Mois</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartMois', 'mois.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartMois" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneMois">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableMois" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Graphique par vm -->
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i> Moyenne par VMP</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartVm', 'vmp.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartVm" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneVm">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableVm" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Graphique par Région -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-map-marker"></i> Taux de réalisation des objectifs en % par Région</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartRegion', 'region.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartRegionGlobal" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneRegionGlobal">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableRegionGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Ligne -->
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-line-chart"></i> Taux de réalisation des objectifs en % par Ligne</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartLigne', 'ligne.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartLigneGlobal" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneLigneGlobal">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableLigneGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <!-- Graphique par Superviseur -->
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i>Taux de réalisation des objectifs en % par Superviseur</h3>
                <button class="btn btn-xs btn-default pull-right"
                    onclick="downloadChart('chartSuper', 'superviseur.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartSuperGlobal" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneSuperGlobal">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableSuperGlobal" class="table table-bordered table-striped"></table>
            </div>
        </div>
    </div>

    <!-- Graphique par Mois -->
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"> <i class="fa fa-calendar"></i>Taux de réalisation des objectifs en % par Mois</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartMois', 'mois.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartMoisGlobal" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneMoisGlobal">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableMoisGlobal" class="table table-bordered table-striped"></table>
            </div>
            
        </div>
    </div>
</div>
<div class="row">
    <!-- Graphique par vm -->
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-user-circle"></i>Taux de réalisation des objectifs en % par VMP</h3>
                <button class="btn btn-xs btn-default pull-right" onclick="downloadChart('chartVm', 'vmp.png')">
                    <i class="fa fa-download"></i> Télécharger image
                </button>
            </div>
            <div class="box-body">
                <canvas id="chartVmGlobal" width="400" height="300"></canvas>
            </div>
            <div class="box-footer text-center">
                <small class="text-muted">Moyenne générale: <strong id="moyenneVmGlobal">0</strong></small>
            </div>
            <div class="table-responsive">
                <table id="tableVmGlobal" class="table table-bordered table-striped"></table>
            </div>
            
        </div>
    </div>
</div>

<!-- Inclure Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>



<?php
echo $this->Html->script('jquery-2.2.3.min');
echo $this->Html->script('daterangepicker');
?>


<script type="text/javascript">
    // --- Fonction téléchargement chart en PNG
    function downloadChart(canvasId, filename) {
        var link = document.createElement('a');
        link.href = document.getElementById(canvasId).toDataURL('image/png');
        link.download = filename;
        link.click();
    }
    // Configuration générale des graphiques
    Chart.defaults.global.responsive = true;
    Chart.defaults.global.maintainAspectRatio = false;

    // Couleurs pour les différents graphiques
    var colors = {
        region: '#3c8dbc',
        vm: '#e6162bff',
        ligne: '#00a65a',
        super: '#f39c12',
        mois: '#00c0ef'
    };

    // Fonction pour créer un graphique
    function createChart(canvasId, data, color, title) {
        var ctx = document.getElementById(canvasId).getContext('2d');

        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Moyenne visites/jour',
                    data: data.values,
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                return value.toFixed(1);
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel.toFixed(2);
                        }
                    }
                },
                animation: {
                    onComplete: function () {
                        var ctx = this.chart.ctx;
                        ctx.font = "12px Arial";
                        ctx.fillStyle = "#444";
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = this.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data.toFixed(1), bar._model.x, bar._model.y - 5);
                            });
                        }, this);
                    }
                }
            }
        });
    }

    // Variables JavaScript avec données PHP
    var vmData = {
        labels: <?php echo json_encode($vm_labels); ?>,
        values: <?php echo json_encode($vm_data); ?>
    };
    var vm_data_global = {
        labels: <?php echo json_encode($vm_labels); ?>,
        values: <?php echo json_encode($vm_data_global); ?>
    };

    var regionsData = {
        labels: <?php echo json_encode($regions_labels); ?>,
        values: <?php echo json_encode($regions_data); ?>
    };
    var regions_data_global = {
        labels: <?php echo json_encode($regions_labels); ?>,
        values: <?php echo json_encode($regions_data_global); ?>
    };

    var lignesData = {
        labels: <?php echo json_encode($lignes_labels); ?>,
        values: <?php echo json_encode($lignes_data); ?>
    };
    var lignes_data_global = {
        labels: <?php echo json_encode($lignes_labels); ?>,
        values: <?php echo json_encode($lignes_data_global); ?>
    };

    var supersData = {
        labels: <?php echo json_encode($supers_labels); ?>,
        values: <?php echo json_encode($supers_data); ?>
    };
    var supers_data_global = {
        labels: <?php echo json_encode($supers_labels); ?>,
        values: <?php echo json_encode($supers_data_global); ?>
    };

    var moisData = {
        labels: <?php echo json_encode($mois_labels); ?>,
        values: <?php echo json_encode($mois_data); ?>
    };
    var mois_data_global = {
        labels: <?php echo json_encode($mois_labels); ?>,
        values: <?php echo json_encode($mois_data_global); ?>
    };

    // Initialisation quand le DOM est prêt
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM chargé, initialisation des graphiques...');
        // Affichage des moyennes globales
        document.getElementById('moyenneRegion').innerHTML = '<?php echo number_format($moyenne_globale_region, 2); ?>';
        document.getElementById('moyenneLigne').innerHTML = '<?php echo number_format($moyenne_globale_ligne, 2); ?>';
        document.getElementById('moyenneSuper').innerHTML = '<?php echo number_format($moyenne_globale_super, 2); ?>';
        document.getElementById('moyenneMois').innerHTML = '<?php echo number_format($moyenne_globale_mois, 2); ?>';
        document.getElementById('moyenneVm').innerHTML = '<?php echo number_format($moyenne_globale_vm, 2); ?>';

        // Création des graphiques avec vérification
        try {
            if (regionsData.labels.length > 0) {
                console.log('Création graphique régions');
                createChart('chartRegion', regionsData, colors.region, 'Régions');
                createChart('chartRegionGlobal', regions_data_global, colors.region, 'Régions Objectifs');
            }
            if (vmData.labels.length > 0) {
                console.log('Création graphique VMP');
                createChart('chartVm', vmData, colors.vm, 'VMP');
                createChart('chartVmGlobal', vm_data_global, colors.vm, 'VMP Objectifs');
            }

            if (lignesData.labels.length > 0) {
                console.log('Création graphique lignes');
                createChart('chartLigne', lignesData, colors.ligne, 'Lignes');
                createChart('chartLigneGlobal', lignes_data_global, colors.ligne, 'Lignes Objectifs');
            }

            if (supersData.labels.length > 0) {
                console.log('Création graphique superviseurs');
                createChart('chartSuper', supersData, colors.super, 'Superviseurs');
                createChart('chartSuperGlobal', supers_data_global, colors.super, 'Superviseurs Objectifs');
            }

            if (moisData.labels.length > 0) {
                console.log('Création graphique mois');
                createChart('chartMois', moisData, colors.mois, 'Mois');
                createChart('chartMoisGlobal', mois_data_global, colors.mois, 'Mois Objectifs');
            }
        } catch (error) {
            console.error('Erreur lors de la création des graphiques:', error);
        }
    });
    // --- Fonction pour créer un tableau DataTable
    function createTable(tableId, labels, values) {
        var table = $('#' + tableId).DataTable({
            data: labels.map(function (label, i) {
                return [label, values[i].toFixed(2)];
            }),
            columns: [
                { title: "Nom" },
                { title: "Moyenne visites/jour" }
            ],
            destroy: true,
            dom: 'Bfrtip',
            searching: false,
            buttons: [
                { extend: 'excelHtml5', text: 'Export Excel', className: 'btn btn-success btn-sm' }
            ]
        });
    }

    // --- Initialisation après DOM chargé
    document.addEventListener('DOMContentLoaded', function () {
        // Création des tableaux à partir des mêmes données
        if (regionsData.labels.length > 0) {
            createTable('tableRegion', regionsData.labels, regionsData.values);
            createTable('tableRegionGlobal', regionsData.labels, regions_data_global.values);
        }
        if (lignesData.labels.length > 0) {
            createTable('tableLigne', lignesData.labels, lignesData.values);
            createTable('tableLigneGlobal', lignesData.labels, lignes_data_global.values);
        }
        if (supersData.labels.length > 0) {
            createTable('tableSuper', supersData.labels, supersData.values);
            createTable('tableSuperGlobal', supersData.labels, supers_data_global.values);
        }
        if (moisData.labels.length > 0) {
            createTable('tableMois', moisData.labels, moisData.values);
            createTable('tableMoisGlobal', moisData.labels, mois_data_global.values);
        }
        if (vmData.labels.length > 0) {
            createTable('tableVm', vmData.labels, vmData.values);
            createTable('tableVmGlobal', vmData.labels, vm_data_global.values);
        }
    });
</script>

<style>
    /* Styles personnalisés pour les graphiques */
    .box-body {
        position: relative;
        height: 370px;
    }

    .box-footer {
        background-color: #f9f9f9;
        border-top: 1px solid #f4f4f4;
    }

    .box-title {
        font-weight: 600;
    }

    /* Responsive pour mobile */
    @media (max-width: 768px) {
        .col-md-6 {
            margin-bottom: 20px;
        }

        .box-body {
            height: 300px;
        }
    }
</style>


<script>
    $(function () {
        $('#reservationtime').daterangepicker({
            format: 'MM/DD/YYYY',
            locale: {
                "format": "YYYY-MM-DD",
                "separator": " -- ",
                "applyLabel": "Valider",
                "cancelLabel": "Annuler",
                "fromLabel": "De",
                "toLabel": "à",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "Dim",
                    "Lun",
                    "Mar",
                    "Mer",
                    "Jeu",
                    "Ven",
                    "Sam"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            },
            clickApply: function (e) {
                this.updateInputText();
            }
        });
    });
    $(function () {
        $('.display').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        });
        $('.choix_multi').select2();
    });

</script>