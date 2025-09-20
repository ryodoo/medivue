<?php
App::uses('AppController', 'Controller');
/**
 * Postes Controller
 *
 * @property Poste $Poste
 * @property PaginatorComponent $Paginator
 */
class PostesController extends AppController {

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
		$this->Poste->recursive = 0;
		$this->set('postes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Poste->exists($id)) {
			throw new NotFoundException(__('Invalid poste'));
		}
		$options = array('conditions' => array('Poste.' . $this->Poste->primaryKey => $id));
		$this->set('poste', $this->Poste->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Poste->create();
			if ($this->Poste->save($this->request->data)) {
				$this->Session->setFlash(__('The poste has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The poste could not be saved. Please, try again.'));
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
		if (!$this->Poste->exists($id)) {
			throw new NotFoundException(__('Invalid poste'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Poste->save($this->request->data)) {
				$this->Session->setFlash(__('The poste has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The poste could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Poste.' . $this->Poste->primaryKey => $id));
			$this->request->data = $this->Poste->find('first', $options);
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
		if (!$this->Poste->exists($id)) {
			throw new NotFoundException(__('Invalid poste'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Poste->delete($id)) {
			$this->Session->setFlash(__('The poste has been deleted.'));
		} else {
			$this->Flash->error(__('The poste could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
