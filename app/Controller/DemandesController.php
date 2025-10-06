<?php
App::uses('AppController', 'Controller');
App::uses('CompositionsController', 'Controller');

class DemandesController extends AppController
{ 
	//ok 


	public function index()
	{
		$this->Demande->recursive = 0;
		$this->set('demandes', $this->Demande->find("all"));
	}
	public function index_stock()
	{
		$this->Demande->recursive = 0;
		$demandes = $this->Demande->find("all", array("conditions" => array("Demande.etat" => "Demande en cours")));
		$this->set('demandes', $demandes);
	}
	public function index_bloc()
	{
		$demandes = [];
		if (isset($this->request->data['Demande']['bloc_id'])) {
			$this->Demande->Bloc->recursive = -1;
			$bloc = $this->Demande->Bloc->findByRef($this->request->data['Demande']['bloc_id']);

			if ($bloc) {
			} else {
				$this->Session->setFlash(__('code introuvable pour le bloc opératoire.'));
				return $this->redirect($this->referer());
			}
			$this->Demande->recursive = 0;
			$demandes = $this->Demande->find("all", array("conditions" => array("Demande.bloc_id " => $bloc["Bloc"]['id'],"Demande.etat !='Demande livrée'")));
		}
		$this->set('demandes', $demandes);
	}

	function liste_demandes_en_cours_livraison()
	{
		$this->Demande->recursive = 0;
		$this->set('demandes', $this->Demande->find("all", array("conditions" => array("Demande.etat" => "En cours de livraison"))));
	}
	function liste_demandes_en_cours()
	{
		$this->Demande->recursive = 0;
		$this->set('demandes', $this->Demande->find("all", array("conditions" => array("Demande.etat" => "Demande en cours"))));
	}

	public function view($id = null)
	{
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$demande = $this->Demande->findById($id);
		$this->loadModel('Composition');
		$this->Composition->recursive = -1;
		$compositions = $this->Composition->find('list');
		$users = $this->Demande->User->find("list");
		$this->set(compact('compositions', 'demande','users'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Demande->Bloc->recursive = -1;
			$bloc = $this->Demande->Bloc->findByRef($this->request->data['Demande']['bloc_id']);

			if ($bloc) {
				$this->request->data['Demande']['bloc_id'] = $bloc['Bloc']['id'];
			} else {
				$this->Session->setFlash(__('code introuvable pour le bloc opératoire.'));
				return $this->redirect($this->referer());
			}
			$this->Demande->User->recursive = -1;
			$user = $this->Demande->User->findByRef($this->request->data['Demande']['user_id']);
			if ($user) {
				$this->request->data['Demande']['user_id'] = $user['User']['id'];
				$this->Demande->create();
				if ($this->Demande->save($this->request->data)) {

					foreach ($this->request->data['Demande']['composition_id'] as $s) {
						$ds = [];
						$ds['demande_id'] = $this->Demande->id;
						$ds['composition_id'] = $s;
						$this->Demande->Demandecomposition->create();
						$this->Demande->Demandecomposition->save($ds);
					}
					$this->Session->setFlash(__('Demande ajoutée avec succès.'));
					return $this->redirect(array('action' => 'view', $this->Demande->id));
				} else {
					$this->Session->setFlash(__('Erreur dans ma demande. Veuillez réessayer.'));
				}
			} else {
				$this->Session->setFlash(__('code introuvable.'));
			}

		}
		$specialites = $this->Demande->Specialite->find('list');
		$medecins = $this->Demande->Medecin->find('list');
		// hadi normalement khasha tji avec ajax apres le choix de medcins et/ou specialite jib data men affectations
		$this->loadModel('Composition');
		$compositions = $this->Composition->find('list');
		$blocs = $this->Demande->Bloc->find('list');
		$this->set(compact('specialites', 'medecins', 'compositions', 'blocs'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null)
	{
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Demande->save($this->request->data)) {
				$this->Session->setFlash(__('The demande has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The demande could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Demande.' . $this->Demande->primaryKey => $id));
			$this->request->data = $this->Demande->find('first', $options);
		}
		$users = $this->Demande->User->find('list');
		$specialites = $this->Demande->Specialite->find('list');
		$medecins = $this->Demande->Medecin->find('list');
		$this->set(compact('users', 'specialites', 'medecins'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Demande->delete($id)) {
			$this->Session->setFlash(__('La demande a été supprimée.'));
		} else {
			$this->Flash->error(__('La demande n\'a pas pu être supprimée. Veuillez réessayer.'));
		}
		return $this->redirect($this->referer());
	}


	public function delete_demandecomposition($id = null)
	{
		if (!$this->Demande->Demandecomposition->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Demande->Demandecomposition->delete($id)) {
			$this->Session->setFlash(__('La composition a été supprimée.'));
		} else {
			$this->Flash->error(__('La composition n\'a pas pu être supprimée. Veuillez réessayer.'));
		}
		return $this->redirect($this->referer());
	}


	function lancer_livraison($id = null)
	{
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$demande = $this->Demande->findById($id);
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('User');
			$this->User->recursive = -1;
			$user1 = $this->User->findByRef($this->request->data['Demande']['livrer_par']);
			if ($user1) {
				$demande['Demande']['livrer_par'] = $user1['User']['id'];
			} else {
				$this->Session->setFlash(__('code introuvable pour agent de livraison.'));
				return $this->redirect($this->referer());
			}
			$user2 = $this->User->findByRef($this->request->data['Demande']['stock_par']);
			if ($user2) {
				$demande['Demande']['stock_par'] = $user2['User']['id'];
			} else {
				$this->Session->setFlash(__('code introuvable pour agent de stock.'));
				return $this->redirect($this->referer());
			}
			foreach ($this->request->data['composition'] as $c) {
				$found = false;
				foreach ($demande['Demandecomposition'] as $k => $ds) {
					if ($ds['composition_id']) {
						$compositionController = new CompositionsController();
						$comp = $compositionController->check_and_update($ds['composition_id'], "En cours de livraison");
						if ($comp["Composition"]['code'] == $c) {
							$found = true;
						}
					}
				}
				if (!$found) {
					$this->Session->setFlash(__('Code ' . $c . ' non demandé dans cette demande.'));
					return $this->redirect($this->referer());
				}
			}

			$demande['Demande']['etat'] = "En cours de livraison";
			$demande['Demande']['date_livraison'] = date('Y-m-d H:i:s');
			if ($this->Demande->save($demande)) {
				$this->Session->setFlash(__('La demande a été lancée pour livraison.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error(__('La demande n\'a pas pu être lancée. Veuillez réessayer.'));
				return $this->redirect($this->referer());
			}

		}
		$this->loadModel('Composition');
		$this->Composition->recursive = -1;

		foreach ($demande['Demandecomposition'] as $k => $ds) {
			if ($ds['composition_id']) {
				$comp = $this->Composition->findById($ds['composition_id']);
				$d = [];
				$d["controller"] = "compositions";
				$d["type"] = "Composition";
				$d["id"] = $ds['id'];
				$d["detail_id"] = $ds['composition_id'];
				$d["name"] = $comp["Composition"]['name'];
				$d["code"] = $comp["Composition"]['code'];
				$data[] = $d;
			}
		}
		$this->set(compact('data', 'demande'));
	}


	function confirmer_livraison($id = null)
	{
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$demande = $this->Demande->findById($id);
		if ($this->request->is(array('post', 'put'))) {
			$this->loadModel('User');
			$this->User->recursive = -1;
			$user1 = $this->User->findByRef($this->request->data['Demande']['recu_par']);
			if ($user1) {
				$demande['Demande']['recu_par'] = $user1['User']['id'];
			} else {
				$this->Session->setFlash(__('code introuvable pour agent de réception.'));
				return $this->redirect($this->referer());
			}

			foreach ($this->request->data['composition'] as $c) {
				$found = false;
				foreach ($demande['Demandecomposition'] as $k => $ds) {
					if ($ds['composition_id']) {
						$compositionController = new CompositionsController();
						$comp = $compositionController->check_and_update($ds['composition_id'], "Dans bloc operatoire");
						if ($comp["Composition"]['code'] == $c['ref']) 
						{
							$found = true;
							$this->Demande->Demandecomposition->id = $ds['id'];
							$this->Demande->Demandecomposition->saveField('conforme', $c['conforme']);
							$this->Demande->Demandecomposition->saveField('remarque', $c['remarque']);
						}
					}
				}
				if (!$found) {
					$this->Session->setFlash(__('Code ' . $c . ' non demandé dans cette demande.'));
					return $this->redirect($this->referer());
				}
			}

			$demande['Demande']['etat'] = "Demande livrée";
			$demande['Demande']['confirmer_livraison'] = date('Y-m-d H:i:s');
			if ($this->Demande->save($demande)) {
				$this->Session->setFlash(__('La demande a été livrée.'));
				return $this->redirect(array('action' => 'view', $id));
			} else {
				$this->Flash->error(__('La demande n\'a pas pu être livrée. Veuillez réessayer.'));
				return $this->redirect($this->referer());
			}

		}
		$this->loadModel('Composition');
		$this->Composition->recursive = -1;

		foreach ($demande['Demandecomposition'] as $k => $ds) {
			if ($ds['composition_id']) {
				$comp = $this->Composition->findById($ds['composition_id']);
				$d = [];
				$d["controller"] = "compositions";
				$d["type"] = "Composition";
				$d["id"] = $ds['id'];
				$d["detail_id"] = $ds['composition_id'];
				$d["name"] = $comp["Composition"]['name'];
				$d["code"] = $comp["Composition"]['code'];
				$data[] = $d;
			}
		}
		$this->set(compact('data', 'demande'));
	}
}
