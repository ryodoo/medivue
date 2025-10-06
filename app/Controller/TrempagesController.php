<?php
App::uses('AppController', 'Controller');
App::uses('CompositionsController', 'Controller');

/**
 * Trempages Controller
 *
 * @property Trempage $Trempage
 * @property PaginatorComponent $Paginator
 */
class TrempagesController extends AppController
{
	public function index()
	{
		if ($this->request->is('post')) 
		{
			$bac = $this->Trempage->Bac->findByRef($this->request->data['Trempage']['bac_ref']);
			if ($bac) {
				return $this->redirect(array('action' => 'view', $bac['Bac']['id']));
			}
			else {
				$this->Session->setFlash(__('code introuvable de Bac.'));
				return $this->redirect($this->referer());
			}
		}
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($bac_id = null)
	{
		$trempages = $this->Trempage->find('all', array('conditions' => array('Trempage.bac_id' => $bac_id)));
		//debug($trempages);exit();
		$trempage = [];
		if (count($trempages) >= 1)
			$trempage = $trempages[0];
		$this->Trempage->User->recursive = -1;
		$retirer = $this->Trempage->User->findById($trempage['Trempage']['retirer_par']);
		$this->set(compact('retirer', 'trempage', 'trempages'));
	}

	public function retirer($bac_id = null)
	{
		$trempages = $this->Trempage->find('all', array('fields' => array('id', 'Composition.name'), 'conditions' => array('Trempage.bac_id' => $bac_id, 'Trempage.retirer_par ' => null)));
		$temps = [];
		foreach ($trempages as $t) {
			$temps[$t['Trempage']['id']] = $t['Composition']['name'];
		}
		$trempages = $temps;

		if ($this->request->is('post')) {
			$this->loadModel('User');
			$this->User->recursive = -1;
			$user = $this->User->findByRef($this->request->data['Trempage']['retirer_par']);
			$retirer_par = null;
			$commentaire_retirer = null;
			if ($user) {
				$retirer_par = $user['User']['id'];
				$commentaire_retirer = $this->request->data['Trempage']['comentaire_retirer'];
			} else {
				$this->Session->setFlash(__('code introuvable pour l\'utilisateur.'));
				return $this->redirect(array('action' => 'index'));
			}

			foreach ($this->request->data['Trempage']['trempage_id'] as $k => $v) {
				$this->Trempage->id = $v;
				$this->Trempage->saveField('retirer_par', $retirer_par);
				$this->Trempage->saveField('date_retirage', date('Y-m-d H:i:s'));
				$this->Trempage->saveField('commentaire_retirer', $commentaire_retirer);
				$compositionController = new CompositionsController();
				$this->Trempage->recursive = -1;
				$tempe=$this->Trempage->findById($v);
				$comp = $compositionController->check_and_update($tempe['Trempage']['composition_id'], "Dans la zone sale");
			}
			$this->Session->setFlash(__('Retrait des compositions enregistré.'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('trempages', $trempages);
	}



	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		$compositions = [];
		if ($this->request->is('post')) {
			if (empty($this->request->data['Trempage']['user_id'])) {
				$this->loadModel('Bloc');
				$this->loadModel('Demandecomposition');
				$bloc = $this->Bloc->findByRef($this->request->data['Trempage']['bloc_id']);

				if ($bloc) {
					$this->request->data['Trempage']['bloc_id'] = $bloc['Bloc']['id'];
				} else {
					$this->Session->setFlash(__('code introuvable pour le bloc opératoire.'));
					return $this->redirect($this->referer());
				}
				$demandes = $this->Demandecomposition->find('all', array('conditions' => array('Demande.bloc_id' => $bloc['Bloc']['id'], 'Demande.etat' => 'Demande livrée')));
				foreach ($demandes as $demande) {
					$compositions[$demande["Composition"]["id"]] = $demande["Composition"]["name"];
				}
			} else {
				$this->loadModel('User');
				$this->User->recursive = -1;
				$user = $this->User->findByRef($this->request->data['Trempage']['user_id']);

				if ($user) {
					$this->request->data['Trempage']['user_id'] = $user['User']['id'];
				} else {
					$this->Session->setFlash(__('code introuvable pour l\'utilisateur.'));
					return $this->redirect($this->referer());
				}

				$bac = $this->Trempage->Bac->findByRef($this->request->data['Trempage']['bac_id']);

				if ($bac) {
					$this->request->data['Trempage']['bac_id'] = $bac['Bac']['id'];
				} else {
					$this->Session->setFlash(__('code introuvable de Bac.'));
					return $this->redirect($this->referer());
				}


				foreach ($this->request->data['Trempage']['composition_id'] as $key => $value) {
					$this->Trempage->create();
					$this->request->data['Trempage']['composition_id'] = $value;
					$this->request->data['Trempage']['date_trampage'] = date('Y-m-d H:i:s');
					$this->Trempage->save($this->request->data);
					$compositionController = new CompositionsController();
					$comp = $compositionController->check_and_update($value, "Dans Trempage");
				}
				$this->Session->setFlash(__('Compte à rebours de trempage enregistré.'));
				return $this->redirect(array('action' => 'view', $this->request->data['Trempage']['bac_id']));
			}

		}
		$this->set(compact('compositions'));
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
		if (!$this->Trempage->exists($id)) {
			throw new NotFoundException(__('Invalid trempage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Trempage->save($this->request->data)) {
				$this->Session->setFlash(__('The trempage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trempage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Trempage.' . $this->Trempage->primaryKey => $id));
			$this->request->data = $this->Trempage->find('first', $options);
		}
		$bacs = $this->Trempage->Bac->find('list');
		$users = $this->Trempage->User->find('list');
		$compositions = $this->Trempage->Composition->find('list');
		$this->set(compact('bacs', 'users', 'compositions'));
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
		if (!$this->Trempage->exists($id)) {
			throw new NotFoundException(__('Invalid trempage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Trempage->delete($id)) {
			$this->Session->setFlash(__('The trempage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The trempage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
