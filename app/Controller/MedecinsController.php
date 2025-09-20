<?php
App::uses('AppController', 'Controller');
/**
 * Medecins Controller
 *
 * @property Medecin $Medecin
 * @property PaginatorComponent $Paginator
 */
class MedecinsController extends AppController {

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
		$this->Medecin->recursive = 0;
		$this->set('medecins', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Medecin->exists($id)) {
			throw new NotFoundException(__('Invalid medecin'));
		}
		$options = array('conditions' => array('Medecin.' . $this->Medecin->primaryKey => $id));
		$this->set('medecin', $this->Medecin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Medecin->create();
			if ($this->Medecin->save($this->request->data)) {
				$this->Session->setFlash(__('The medecin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The medecin could not be saved. Please, try again.'));
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
		if (!$this->Medecin->exists($id)) {
			throw new NotFoundException(__('Invalid medecin'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Medecin->save($this->request->data)) {
				$this->Session->setFlash(__('The medecin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The medecin could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Medecin.' . $this->Medecin->primaryKey => $id));
			$this->request->data = $this->Medecin->find('first', $options);
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
		if (!$this->Medecin->exists($id)) {
			throw new NotFoundException(__('Invalid medecin'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Medecin->delete($id)) {
			$this->Session->setFlash(__('The medecin has been deleted.'));
		} else {
			$this->Flash->error(__('The medecin could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
