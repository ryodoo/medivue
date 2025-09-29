<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Absences');

class AnalysesController extends AppController
{
	public function moyenne_visites()
	{
		// =============================================================================
		// CONFIGURATION SÉCURITÉ ET RESSOURCES
		// =============================================================================
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// =============================================================================
		// CHARGEMENT DES MODÈLES
		// =============================================================================
		$models = array('Client', 'Secteur', 'Game', 'Visite', 'Category', 'User', 'Apartient');
		foreach ($models as $model) {
			$this->loadModel($model);
			$this->{$model}->recursive = -1;
		}

		// =============================================================================
		// VARIABLES PAR DÉFAUT
		// =============================================================================
		$dateaafficherdansleview = "";
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions_visite = array('Visite.archive' => 1);
		$conditions_client = array('Client.archive' => 1);
		$users_id = array();
		$types = array();

		// =============================================================================
		// TRAITEMENT DES DONNÉES POST
		// =============================================================================
		if ($this->request->is('post')) {
			$data = $this->request->data;
			// -------------------------------------------------------------------------
			// TRAITEMENT DES DATES (crée une condition BETWEEN pour Visite.date)
			// -------------------------------------------------------------------------
			if (!empty($data["date"])) {
				$dateaafficherdansleview = h($data["date"]);
				$dates = explode(" -- ", $data["date"]);
				if (count($dates) === 2) {
					$date_debut = date('Y-m-d', strtotime($dates[0]));
					$date_fin = date('Y-m-d', strtotime($dates[1]));
					$conditions_visite["DATE(Visite.date) BETWEEN '" . $date_debut . "' AND '" . $date_fin . "'"] = "";
				}
			}

			// -------------------------------------------------------------------------
			// FILTRES CLIENTS
			// -------------------------------------------------------------------------
			if (!empty($data["activite"])) {
				$conditions_client['Client.activite'] = h($data["activite"]);
			}

			if (!empty($data["type"]) && is_array($data["type"])) {
				// Liste des types qui servira pour calculer l'objectif
				$types = array_map('intval', $data["type"]);
				$conditions_client['Client.type_id'] = $types;
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR SECTEURS/RÉGIONS (on traduit liste d'IDs -> régions -> secteurs)
			// -------------------------------------------------------------------------
			if (!empty($data["secteur_id"]) && is_array($data["secteur_id"])) {
				$secteur_ids = array_map('intval', $data["secteur_id"]);
				$regions = $this->Secteur->find('list', array(
					'fields' => array('Secteur.region', 'Secteur.region'),
					'conditions' => array('Secteur.id' => $secteur_ids)
				));
				$secteurs = $this->Secteur->find('list', array(
					'fields' => array('Secteur.id', 'Secteur.id'),
					'conditions' => array('Secteur.region' => array_keys($regions))
				));
				$conditions_client['Client.secteur_id'] = array_keys($secteurs);
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR CATÉGORIES
			// -------------------------------------------------------------------------
			if (!empty($data["category_id"]) && is_array($data["category_id"])) {
				$conditions_client['Client.category_id'] = array_map('intval', $data["category_id"]);
			}

			// =============================================================================
			// RÉCUPÉRATION DES UTILISATEURS SELON RÔLE/CRITÈRES
			// =============================================================================
			if (!empty($data["ligne"]) && is_array($data["ligne"])) {
				$ligne_ids = array_map('intval', $data["ligne"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.ligne_id' => $ligne_ids, 'User.archive !=' => -1)
				));
			} elseif (!empty($data["users"]) && is_array($data["users"])) {
				$user_ids = array_map('intval', $data["users"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.id' => $user_ids, 'User.archive !=' => -1)
				));
			} elseif (AuthComponent::user('role') == 'Super viseur') {
				// Superviseur : récupère ses VMP + lui-même
				$apartients = $this->Apartient->find('all', array(
					'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
				));
				foreach ($apartients as $u) {
					if ($u['User1']['archive'] != -1) {
						$users_id[$u["User1"]["id"]] = $u["User1"]["name"];
					}
				}
				$current_user = $this->User->findById(AuthComponent::user('id'));
				$users_id[$current_user["User"]["id"]] = $current_user["User"]["name"];
			} else {
				// Tous les utilisateurs autorisés
				$users_id = $this->User->find("list", array(
					'conditions' => array(
						'User.archive' => 1,
						'User.id NOT' => array(2, 4),
						'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
					)
				));
			}

			// =============================================================================
			// RÉCUPÉRATION DES ABSENCES POUR LA PÉRIODE GLOBALE CHOISIE
			// (on s'en sert pour objectifs & jours travaillés)
			// =============================================================================
			$absences = array();
			$absencesController = new AbsencesController;
			foreach ($users_id as $user_id => $user_name) {
				// Retour attendu: ["jours_travailles"], ["Total_objectif"], ["Type"][type_id]...
				$absences[$user_id] = $absencesController->system_get_jour_absence($user_id, $date_debut, $date_fin);
			}
			//debug($absences);

			// =============================================================================
			// RÉCUPÉRATION DES VISITES
			// =============================================================================
			$user_ids_array = array_keys($users_id);
			$conditions_visite['Visite.user_id'] = $user_ids_array;
			$all_conditions = array_merge($conditions_visite, $conditions_client);

			$visites = $this->Visite->find('all', array(
				'fields' => array(
					'Visite.date',
					'Visite.user_id',
					'User.ligne_id',
					'Client.id',
					'Client.nom',
					'Secteur.region',
					'Category.name'
				),
				'conditions' => $all_conditions,
				'joins' => array(
					array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id = Visite.client_id')),
					array('table' => 'secteurs', 'alias' => 'Secteur', 'type' => 'LEFT', 'conditions' => array('Secteur.id = Client.secteur_id')),
					array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id = Client.category_id')),
					array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Visite.user_id'))
				)
			));

			// =============================================================================
			// MAPPING DES SUPERVISEURS (user_id VMP -> user_id Superviseur)
			// =============================================================================
			$superviseur_conditions = array();
			if (AuthComponent::user('role') == 'Super viseur') {
				$superviseur_conditions['Apartient.user_id'] = AuthComponent::user('id');
			}
			$superviseurs = $this->Apartient->find('list', array(
				'fields' => array('Apartient.user1_id', 'Apartient.user_id'),
				'conditions' => $superviseur_conditions
			));

			// =============================================================================
			// INITIALISATION DES STRUCTURES DE DONNÉES
			// =============================================================================
			$data_moyenne = array(
				'par_vm' => array(),
				'par_region' => array(),
				'par_ligne' => array(),
				'par_super' => array(),
				'par_mois' => array()
			);

			// =============================================================================
			// 1) COMPTAGE DES VISITES POUR LES 4 REGROUPEMENTS "CLASSIQUES"
			// =============================================================================
			foreach ($visites as $v) {
				$user_id = $v['Visite']['user_id'];

				$region = !empty($v['Secteur']['region']) ? $v['Secteur']['region'] : 'Non définie';
				$ligne_id = !empty($v['User']['ligne_id']) ? $v['User']['ligne_id'] : 0;
				$super_id = isset($superviseurs[$user_id]) ? $superviseurs[$user_id] : $user_id;

				$groupements = array(
					'par_vm' => $user_id,
					'par_region' => $region,
					'par_ligne' => $ligne_id,
					'par_super' => $super_id
				);

				foreach ($groupements as $type_group => $cle_group) {
					if (!isset($data_moyenne[$type_group][$cle_group][$user_id])) {
						$data_moyenne[$type_group][$cle_group][$user_id] = array('total' => 0);
					}
					$data_moyenne[$type_group][$cle_group][$user_id]['total']++;
				}
			}

			// =============================================================================
			// 2) CALCUL COMPLET (objectif, absences, moyennes) POUR LES 4 REGROUPEMENTS
			//    Remarque: on utilise l'objectif et jours_travailles de la période globale
			// =============================================================================
			$types_classiques = array('par_vm', 'par_region', 'par_ligne', 'par_super');

			foreach ($types_classiques as $type_groupement) {

				foreach ($data_moyenne[$type_groupement] as $cle_groupe => &$users_du_groupe) {

					$total_visites_groupe = 0;
					$total_objectif_groupe = 0;
					$total_jours_travailles_groupe = 0;

					foreach ($users_du_groupe as $user_id => &$donnees_user) {
						if (!is_numeric($user_id)) {
							// ignore les clés spéciales (ex: _moyenne_groupe)
							continue;
						}
						if (!isset($absences[$user_id])) {
							// pas d'absences -> impossible de calculer objectifs / jours
							continue;
						}

						// --------- Objectif (soit total, soit somme par types choisis)
						$objectif = 0;
						if (!empty($types)) {
							foreach ($types as $type_id) {
								if (isset($absences[$user_id]["Type"]) && isset($absences[$user_id]["Type"][$type_id])) {
									$objectif += $absences[$user_id]["Type"][$type_id];
								}
							}
						} else {
							$objectif = isset($absences[$user_id]["Total_objectif"]) ? (float) $absences[$user_id]["Total_objectif"] : 0;
						}
						if ($objectif <= 0)
							$objectif = 1; // anti-division par 0

						// --------- Jours travaillés (de la période globale)
						$jours_travailles = isset($absences[$user_id]["jours_travailles"]) ? (float) $absences[$user_id]["jours_travailles"] : 0;
						if ($jours_travailles == 0)
							$jours_travailles = 1; // anti-division par 0

						// --------- Enrichissement des données utilisateur du groupe
						$donnees_user['absences'] = $absences[$user_id];
						$donnees_user['objectif'] = $objectif;
						$donnees_user['moyenne_visite_objectif'] = round(($donnees_user['total'] / $objectif) * 100, 2);
						$donnees_user['moyenne_visite_par_jour'] = (float) round($donnees_user['total'] / $jours_travailles, 2);

						// --------- Accumulation pour la moyenne de ce groupe
						$total_visites_groupe += $donnees_user['total'];
						$total_objectif_groupe += $objectif;
						$total_jours_travailles_groupe += $jours_travailles;
					}
					unset($donnees_user);

					// --------- Moyenne du groupe
					if ($total_objectif_groupe > 0 && $total_jours_travailles_groupe > 0) {
						$users_du_groupe['_moyenne_groupe'] = array(
							'moyenne_visite_objectif' => round(($total_visites_groupe / $total_objectif_groupe) * 100, 2),
							'moyenne_visite_par_jour' => (float) round($total_visites_groupe / $total_jours_travailles_groupe, 2)
						);
					}
				}
				unset($users_du_groupe);

				// --------- Moyenne GLOBALE pour ce type (somme sur tous les groupes)
				$total_visites_global = 0;
				$total_objectif_global = 0;
				$total_jours_global = 0;

				foreach ($data_moyenne[$type_groupement] as $cle_groupe => $users_du_groupe) {
					foreach ($users_du_groupe as $user_id => $donnees_user) {
						if (!is_array($donnees_user) || !isset($donnees_user['total']) || !is_numeric($user_id)) {
							continue;
						}
						$total_visites_global += $donnees_user['total'];
						if (isset($donnees_user['objectif'])) {
							$total_objectif_global += $donnees_user['objectif'];
						}
						if (isset($absences[$user_id]["jours_travailles"])) {
							$total_jours_global += (float) $absences[$user_id]["jours_travailles"];
						}
					}
				}

				if ($total_objectif_global > 0 && $total_jours_global > 0) {
					$data_moyenne[$type_groupement]['_moyenne_globale'] = array(
						'moyenne_visite_objectif' => round(($total_visites_global / $total_objectif_global) * 100, 2),
						'moyenne_visite_par_jour' => (float) round($total_visites_global / $total_jours_global, 2)
					);
				}
			}
			//debug($data_moyenne); //exit();

			// =============================================================================
			// 3) TRAITEMENT ISOLÉ POUR PAR_MOIS
			//    - on groupe les visites par mois "m-Y"
			//    - pour CHAQUE mois, on proportionne objectif & jours aux jours du mois
			//      qui intersectent la période sélectionnée
			// =============================================================================
			$visites_par_mois = array();
			foreach ($visites as $v) {
				$mois_key = date('m-Y', strtotime($v['Visite']['date']));
				if (!isset($visites_par_mois[$mois_key])) {
					$visites_par_mois[$mois_key] = array();
				}
				$visites_par_mois[$mois_key][] = $v;
			}

			$ts_debut_periode = strtotime($date_debut);
			$ts_fin_periode = strtotime($date_fin);

			foreach ($visites_par_mois as $mois => $visites_du_mois) {
				if (!isset($data_moyenne['par_mois'][$mois])) {
					$data_moyenne['par_mois'][$mois] = array();
				}

				// Bornes naturelles du mois (ex: 01-05-2025 à 31-05-2025)
				list($mois_num, $annee) = explode('-', $mois);
				$premier_jour_mois = date('Y-m-01', strtotime($annee . '-' . $mois_num . '-01'));
				$dernier_jour_mois = date('Y-m-t', strtotime($premier_jour_mois));

				// Intersection avec la période globale choisie
				$ts_debut_mois_inter = max($ts_debut_periode, strtotime($premier_jour_mois));
				$ts_fin_mois_inter = min($ts_fin_periode, strtotime($dernier_jour_mois));
				if ($ts_fin_mois_inter < $ts_debut_mois_inter) {
					// Mois entièrement hors période -> on ignore
					continue;
				}

				// --------- Comptage des visites par utilisateur pour ce mois
				foreach ($visites_du_mois as $visite) {
					$uid = $visite['Visite']['user_id'];
					if (!isset($data_moyenne['par_mois'][$mois][$uid])) {
						$data_moyenne['par_mois'][$mois][$uid] = array('total' => 0);
					}
					$data_moyenne['par_mois'][$mois][$uid]['total']++;
				}

				// --------- Calcul par utilisateur (objectif/jours proportionnés au mois)
				$total_visites_groupe = 0;
				$total_objectif_groupe = 0;
				$total_jours_travailles_groupe = 0;

				// Jours dans l'intersection "ce mois ∩ période"
				$jours_dans_mois = (int) floor(($ts_fin_mois_inter - $ts_debut_mois_inter) / (24 * 60 * 60)) + 1;
				// Jours totaux de la période
				$jours_totaux_periode = (int) floor(($ts_fin_periode - $ts_debut_periode) / (24 * 60 * 60)) + 1;
				if ($jours_totaux_periode <= 0)
					$jours_totaux_periode = 1; // sécurité
				$ratio = $jours_dans_mois / $jours_totaux_periode;

				foreach ($data_moyenne['par_mois'][$mois] as $uid => &$du) {
					if (!is_numeric($uid))
						continue;
					if (!isset($absences[$uid]))
						continue;

					// ---- objectif de base (période globale), puis proportionné au mois
					$objectif_base = 0;
					if (!empty($types)) {
						foreach ($types as $type_id) {
							if (isset($absences[$uid]["Type"]) && isset($absences[$uid]["Type"][$type_id])) {
								$objectif_base += (int) $absences[$uid]["Type"][$type_id];
							}
						}
					} else {
						$objectif_base = isset($absences[$uid]["Total_objectif"]) ? (float) $absences[$uid]["Total_objectif"] : 0;
					}
					$objectif_calc = (float) round($objectif_base * $ratio);
					if ($objectif_calc <= 0)
						$objectif_calc = 1;

					// ---- jours travaillés proportionnés au mois
					$jours_trav_base = isset($absences[$uid]["jours_travailles"]) ? (float) $absences[$uid]["jours_travailles"] : 0;
					$jours_trav_calc = (float) round($jours_trav_base * $ratio);
					if ($jours_trav_calc == 0)
						$jours_trav_calc = 1;

					// ---- enrichissement
					$du['absences'] = $absences[$uid];
					$du['objectif'] = $objectif_calc;
					$du['jours_travailles_calc'] = $jours_trav_calc; // utile pour _moyenne_globale par_mois
							//hadi a voir dans  les mois wach kaina oula la hadi ajoutiha rassi ma3raftch wach salha ou pas 19/09/2025
									//$objectif_calc = $absences[$uid]['Total_objectif'];
									//$jours_trav_calc = $absences[$uid]['jours_travailles'];
							// fin rwina dialiiiii
					$du['objectif'] = $objectif_calc;
					$du['jours_travailles_calc'] = $jours_trav_calc;

					$du['moyenne_visite_objectif'] = round(($du['total'] / $objectif_calc) * 100, 2);
					$du['moyenne_visite_par_jour'] = (float) round($du['total'] / $jours_trav_calc, 2);

					// ---- accumulation groupe (ce mois)
					$total_visites_groupe += $du['total'];
					$total_objectif_groupe += $objectif_calc;
					$total_jours_travailles_groupe += $jours_trav_calc;
				}
				unset($du);

				// ---- moyenne du groupe (le mois)
				if ($total_objectif_groupe > 0 && $total_jours_travailles_groupe > 0) {
					$data_moyenne['par_mois'][$mois]['_moyenne_groupe'] = array(
						'moyenne_visite_objectif' => round(($total_visites_groupe / $total_objectif_groupe) * 100, 2),
						'moyenne_visite_par_jour' => (float) round($total_visites_groupe / $total_jours_travailles_groupe, 2)
					);
				}
			}

			// --------- Moyenne GLOBALE pour "par_mois" (somme sur tous les mois)
			$total_visites_global = 0;
			$total_objectif_global = 0;
			$total_jours_global = 0;

			foreach ($data_moyenne['par_mois'] as $mois => $users_du_mois) {
				foreach ($users_du_mois as $uid => $du) {
					if (!is_array($du) || !isset($du['total']) || !is_numeric($uid)) {
						continue;
					}
					$total_visites_global += $du['total'];
					if (isset($du['objectif'])) {
						$total_objectif_global += (float) $du['objectif'];
					}
					// Ici on additionne les "jours travaillés proportionnés" du mois
					if (isset($du['jours_travailles_calc'])) {
						$total_jours_global += (float) $du['jours_travailles_calc'];
					} elseif (isset($du['absences']) && isset($du['absences']['jours_travailles'])) {
						// fallback (ne devrait pas arriver)
						$total_jours_global +=  $du['absences']['jours_travailles'];
					}
				}
			}

			if ($total_objectif_global > 0 && $total_jours_global > 0) {
				$data_moyenne['par_mois']['_moyenne_globale'] = array(
					'moyenne_visite_objectif' => round(($total_visites_global / $total_objectif_global) * 100, 2),
					'moyenne_visite_par_jour' => (float) round($total_visites_global / $total_jours_global, 2),
					"voilaaaaaaaaaaaaaaaaaaaa"=>"$total_visites_global / $total_jours_global = " . round($total_visites_global / $total_jours_global, 2)
				);
			}
			//debug($data_moyenne);//exit();
			// =============================================================================
			// ENVOI DES DONNÉES À LA VUE
			// =============================================================================
			$this->set('data_moyenne', $data_moyenne);
		}

		// =============================================================================
		// PRÉPARATION DES LISTES POUR LES FORMULAIRES (toujours exécuté)
		// =============================================================================
		$allusers = array();
		if (AuthComponent::user('role') == 'Super viseur') {
			$user = $this->Apartient->find('all', array(
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($user as $u) {
				if ($u['User1']['archive'] != -1) {
					$allusers[$u["User1"]["id"]] = $u["User1"]["name"];
				}
			}
			$u = $this->User->findById(AuthComponent::user('id'));
			$allusers[$u["User"]["id"]] = $u["User"]["name"];
		} else {
			$allusers = $this->User->find("list", array(
				'conditions' => array(
					'User.archive' => 1,
					'User.id NOT' => array(2, 4),
					'User.role' => array('Coordinateur', 'Super viseur', 'VMP')
				)
			));
		}

		$tout_user_pour_affchage_dans_le_view = $this->User->find("list");

		$this->set(array(
			'tout_user_pour_affchage_dans_le_view' => $tout_user_pour_affchage_dans_le_view,
			'allusers' => $allusers,
			'secteurs' => $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), 'group' => array('Secteur.region'))),
			'categories' => $this->Category->find('list'),
			'lignes' => $this->User->Ligne->find('list'),
			'games' => $this->Game->find("list"),
			'allsecteurs' => $this->Secteur->find("list"),
			'types' => $this->Client->Type->find("list"),
			'dateaafficherdansleview' => $dateaafficherdansleview
		));
	}



	public function visite_dsm()
	{
		// --- Config
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		$this->loadModel('Client');
		$this->loadModel('Visite');
		$this->Visite->recursive = -1;
		$this->loadModel('Apartient');
		$this->loadModel('User');

		// --- Dates
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions = array();
		$dateaafficherdansleview = "$date_debut -- $date_fin";
		if ($this->request->is('post') && !empty($this->request->data["date"])) {
			$dateaafficherdansleview = $this->request->data["date"];
			$dates = explode(" -- ", $this->request->data["date"]);
			if (count($dates) == 2) {
				$date_debut = date('Y-m-d', strtotime($dates[0]));
				$date_fin = date('Y-m-d', strtotime($dates[1]));
			}
			$ids=[];
			foreach( $this->request->data['super'] as $k => $v) {
				$ids[] = $v;
			}
			$conditions=array('Apartient.user_id' => $ids );
		}

		

		$users = $this->Apartient->find('all', array(
			'fields' => array('Apartient.user_id', 'Apartient.user1_id'),
			'conditions' => $conditions
		));
		//debug($users);

		$supers = array();
		
		foreach ($users as $user) {
			$super_id = $user['Apartient']['user_id'];
			$user_id = $user['Apartient']['user1_id'];
			$supers[$super_id][0] = $super_id; // le superviseur lui-même
			$supers[$super_id][] = $user_id;
			//echo "Superviseur $super_id a le VMP $user_id<br>";
		}

		// --- Récupération visites
		$visites = $this->Visite->find('all', array(
			'fields' => array(
				'Visite.created',
				'Visite.date',
				'Visite.user_id',
				'Visite.type_visite',
				'Client.id',
				'Client.nom',
				'Client.potentialite',
				'Category.name'
			),
			'conditions' => array(
				'Visite.archive' => 1,
				"DATE(Visite.date) BETWEEN '$date_debut' AND '$date_fin'"
			),
			'joins' => array(
				array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id=Visite.client_id')),
				array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id=Client.category_id'))
			)
		));
		//debug($visites);exit();

		// --- Comptage par superviseur
		$data = array();
		foreach ($supers as $super_id => $users) {
			$data[$super_id] = array("solo" => 0, "double" => 0,"total" => 0, "nb_client" => 0, "clients" => array());

			foreach ($visites as $v) {
				if (in_array($v['Visite']['user_id'], $users)) 
				{
					$dialo = 0;
					if ($v['Visite']['type_visite'] == "double") {
						$data[$super_id]["double"]++;
						$data[$super_id]["total"]++;
						$dialo = 1;
					} elseif ($v['Visite']['user_id'] == $super_id) {
						$data[$super_id]["solo"]++;
						$data[$super_id]["total"]++;
						$dialo = 1;
					}
					if ($dialo == 1) {
						if (!isset($data[$super_id]["clients"][$v['Client']['id']]))
							$data[$super_id]["nb_client"]++;
						$data[$super_id]["clients"][$v['Client']['id']] = $v;
					}
				}
			}
		}
		$temp = array();
		$users = $this->User->find('list');
		foreach ($data as $super_id => $d) {
			//if ($d["nb_client"] > 0)
				$temp[$users[$super_id]] = $d;
		}
		$data = $temp;
		$supers=$this->User->find('list',array('conditions'=>array('User.role'=>"Super viseur",'User.archive'=>1)));

		$this->set(array(
			'data' => $data,
			'dateaafficherdansleview' => $dateaafficherdansleview,
			"users" => $users,
			"supers" => $supers
		));
	}



	public function portefeuille_vm()
	{
		// -------------------- Config runtime --------------------
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// -------------------- Models --------------------
		$this->loadModel('Client');
		$this->loadModel('User');
		$this->loadModel('Apartient');   // liens superviseur -> VMP
		$this->loadModel('Affectation'); // liens liste <-> client
		$this->loadModel('Liste');

		$this->Client->recursive = -1;
		$this->User->recursive = -1;
		$this->Apartient->recursive = -1;
		$this->Affectation->recursive = -1;
		$this->Liste->recursive = -1;

		// -------------------- Sélection des users à traiter --------------------
		// - Si Super viseur : uniquement ses VMP (via Apartient)
		// - Sinon : tous les actifs (VMP, Super viseur, Coordinateur) sauf 2 et 4
		$users_id = array();
		if (AuthComponent::user('role') === 'Super viseur') {
			$userssuper = $this->Apartient->find('list', array(
				'fields' => array('Apartient.user_id', 'Apartient.user1_id'), // clé=superviseur, valeur=VMP
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($userssuper as $super_id => $user_id) {
				$users_id[] = (int) $user_id;
			}
		} else {
			$users_id = $this->User->find('list', array(
				'fields' => array('User.id', 'User.id'),
				'conditions' => array(
					'User.archive' => 1,
					'User.id NOT' => array(2, 4),
					'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
				)
			));
			$users_id = array_map('intval', array_values($users_id));
		}

		if (empty($users_id)) {
			$this->set('data', array());
			return;
		}

		// -------------------- Paramètres / constantes métiers --------------------
		// Libellés possibles pour "généraliste" (tolérant aux variantes)
		$generalisteLabels = array('Généraliste', 'Generaliste', 'Médecin généraliste', 'Medecin generaliste');

		// -------------------- Agrégation 1 : spécialités par user --------------------
		// On compte les clients affectés (valides + entités actives) par (user, spécialité).
		// NOTE perfs : prévoir des index (voir notes en bas)
		$specialitesRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Liste.user_id',
				'Category.id',
				'Category.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id', 'Client.type_id !=2')//tout sauf les pharmacies
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category1',
					'type' => 'LEFT',
					'conditions' => array('Category1.id = Client.category1_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				'Liste.user_id' => $users_id
			),
			'group' => array('Liste.user_id', 'Category.id', 'Category.name'),
			'order' => array('Liste.user_id' => 'ASC', 'Category.name' => 'ASC'),
			'recursive' => -1
		));

		// -------------------- Totaux par user pour pourcentages --------------------
		$totauxParUser = array(); // user_id => total clients
		foreach ($specialitesRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$nb = (int) $r[0]['nb']; // agrégat aliasé
			if (!isset($totauxParUser[$uid]))
				$totauxParUser[$uid] = 0;
			$totauxParUser[$uid] += $nb;
		}

		// -------------------- Construction data spécialités par user --------------------
		$data = array(); // structure finale
		foreach ($users_id as $uid) {
			$data[$uid] = array(
				'total_clients' => isset($totauxParUser[$uid]) ? (int) $totauxParUser[$uid] : 0,
				'specialites' => array(),        // pour graphique circulaire
				'tendance_if_generaliste' => array() // rempli plus bas
			);
		}

		foreach ($specialitesRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$label = isset($r['Category']['name']) && $r['Category']['name'] !== null ? $r['Category']['name'] : 'Non renseigné';
			$nb = (int) $r[0]['nb'];
			$total = max(1, (int) $data[$uid]['total_clients']); // évite division par zéro
			$data[$uid]['specialites'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / $total, 2)
			);
		}

		// -------------------- Agrégation 2 : tendances uniquement sur les "généralistes" --------------------
		// On filtre côté SQL sur Category.name IN ($generalisteLabels) (case-insensitive).
		// On groupe par (user, tendance).
		// NB : on reste tolérant aux NULL -> "Non renseigné".
		$tendanceRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Liste.user_id',
				'Category1.id',
				'Category1.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category1',
					'type' => 'LEFT',
					'conditions' => array('Category1.id = Client.category1_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				//'Client.category1_id is not null',
				'Liste.user_id' => $users_id,
				// filtre "généraliste" tolérant aux variations
				'LOWER(Category.name)' => array_map('strtolower', $generalisteLabels)
			),
			'group' => array('Liste.user_id', 'Category1.id', 'Category1.name'),
			'order' => array('Liste.user_id' => 'ASC', 'Category1.name' => 'ASC'),
			'recursive' => -1
		));

		// Totaux "généraliste" par user (pour pourcentages de tendance)
		$totalGeneralistesParUser = array();
		foreach ($tendanceRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$nb = (int) $r[0]['nb'];
			if (!isset($totalGeneralistesParUser[$uid]))
				$totalGeneralistesParUser[$uid] = 0;
			$totalGeneralistesParUser[$uid] += $nb;
		}

		foreach ($tendanceRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			if (isset($r['Category1']['name']) && $r['Category1']['name'] !== null)
				$label = $r['Category1']['name'];
			else
				$label = 'Généraliste';
			$nb = (int) $r[0]['nb'];
			$totalGen = max(1, isset($totalGeneralistesParUser[$uid]) ? (int) $totalGeneralistesParUser[$uid] : 1);
			$data[$uid]['tendance_if_generaliste'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / $totalGen, 2)
			);
		}
		//debug($data);exit();
		// -------------------- Sortie --------------------
		// $data est prêt pour vos graphiques circulaires (spécialités + tendances pour généralistes).
		// Exemple structure :
		// $data[USER_ID]['specialites'] => [ ['label'=>'Pédiatre','count'=>120,'percent'=>12.5], ... ]
		// $data[USER_ID]['tendance_if_generaliste'] => [ ['label'=>'Privé','count'=>40,'percent'=>66.67], ... ]
		// $data[USER_ID]['total_clients'] => 318
		$this->set('data', $data);
		$users = $this->User->find('list');
		$this->set('users', $users);
	}


	public function doublons_vm()
	{
		$this->loadModel('User');
		$this->loadModel('Client');
		$this->loadModel('Liste');
		$this->loadModel('Affectation');

		// Désactiver récursivité pour accélérer
		$this->User->recursive = -1;
		$this->Client->recursive = -1;
		$this->Liste->recursive = -1;
		$this->Affectation->recursive = -1;

		// Requête SQL optimisée : récupérer les clients affectés à plusieurs listes
		$results = $this->Affectation->find('all', [
			'fields' => [
				'User.id',
				'User.name AS vm_name',
				'Client.id',
				'Client.nom AS client_name',
				'Category.name AS specialite',
				'Secteur.region AS region',
				'Secteur.ville AS ville',
				'Secteur.secteur AS secteur',
				'GROUP_CONCAT(DISTINCT Liste.name ORDER BY Liste.name SEPARATOR ", ") AS listes',
				'COUNT(DISTINCT Liste.id) AS nb_listes'
			],
			'joins' => [
				[
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => ['Liste.id = Affectation.liste_id']
				],
				[
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => ['User.id = Liste.user_id']
				],
				[
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => ['Client.id = Affectation.client_id']
				],
				[
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => ['Category.id = Client.category_id']
				],
				[
					'table' => 'secteurs',
					'alias' => 'Secteur',
					'type' => 'LEFT',
					'conditions' => ['Secteur.id = Client.secteur_id']
				],
			],
			'conditions' => [
				'Affectation.valide' => 1,
				'Client.archive' => 1,
				'Liste.archive' => 1
			],
			'group' => ['Client.id', 'User.id'],
			'having' => ['COUNT(DISTINCT Liste.id) > 1'], // ✅ en string pur
			'order' => ['User.id ASC', 'Client.nom ASC']
			//'limit' => 1000 // Limite pour éviter surcharge, ajustez selon vos besoins
		]);

		// Formater les données pour la vue
		$data = [];
		foreach ($results as $r) {
			if($r[0]['nb_listes']<=1) 
				continue;
			$data[$r['User']['id']][] = [
				'vm' => $r["User"]['vm_name'],
				'client' => $r["Client"]['client_name'],
				'client_id' => $r["Client"]['id'],
				'specialite' => $r['Category']['specialite'],
				'localisation' => trim($r['Secteur']['region'] . ', ' . $r['Secteur']['ville'] . ', ' . $r['Secteur']['secteur'], ', '),
				'listes' => $r[0]['listes'],
				'nb_listes' => $r[0]['nb_listes']
			];
		}

		$this->set(compact('data'));
	}


}
