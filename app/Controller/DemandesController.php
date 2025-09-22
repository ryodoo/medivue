<?php
App::uses('AppController', 'Controller');
/**
 * Demandes Controller
 *
 * @property Demande $Demande
 * @property PaginatorComponent $Paginator
 */
class DemandesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Demande->recursive = 0;
		$this->set('demandes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$options = array('conditions' => array('Demande.' . $this->Demande->primaryKey => $id));
		$this->set('demande', $this->Demande->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Demande->create();
			if ($this->Demande->save($this->request->data)) {
				$this->Flash->success(__('The demande has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The demande could not be saved. Please, try again.'));
			}
		}
		$users = $this->Demande->User->find('list');
		$specialites = $this->Demande->Specialite->find('list');
		$medecins = $this->Demande->Medecin->find('list');
		$this->set(compact('users', 'specialites', 'medecins'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Demande->save($this->request->data)) {
				$this->Flash->success(__('The demande has been saved.'));
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
	public function delete($id = null) {
		if (!$this->Demande->exists($id)) {
			throw new NotFoundException(__('Invalid demande'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Demande->delete($id)) {
			$this->Flash->success(__('The demande has been deleted.'));
		} else {
			$this->Flash->error(__('The demande could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
