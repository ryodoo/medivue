<?php
App::uses('AppController', 'Controller');
/**
 * Fournisseurs Controller
 *
 * @property Fournisseur $Fournisseur
 * @property PaginatorComponent $Paginator
 */
class FournisseursController extends AppController {

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
		$this->Fournisseur->recursive = 0;
		$this->set('fournisseurs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Fournisseur->exists($id)) {
			throw new NotFoundException(__('Invalid fournisseur'));
		}
		$options = array('conditions' => array('Fournisseur.' . $this->Fournisseur->primaryKey => $id));
		$this->set('fournisseur', $this->Fournisseur->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Fournisseur->create();
			if ($this->Fournisseur->save($this->request->data)) {
				$this->Session->setFlash(__('The fournisseur has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Fournisseur->exists($id)) {
			throw new NotFoundException(__('Invalid fournisseur'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Fournisseur->save($this->request->data)) {
				$this->Session->setFlash(__('The fournisseur has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The fournisseur could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Fournisseur.' . $this->Fournisseur->primaryKey => $id));
			$this->request->data = $this->Fournisseur->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Fournisseur->exists($id)) {
			throw new NotFoundException(__('Invalid fournisseur'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Fournisseur->delete($id)) {
			$this->Session->setFlash(__('The fournisseur has been deleted.'));
		} else {
			$this->Flash->error(__('The fournisseur could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
