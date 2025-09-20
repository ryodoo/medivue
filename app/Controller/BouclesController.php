<?php
App::uses('AppController', 'Controller');
/**
 * Boucles Controller
 *
 * @property Boucle $Boucle
 * @property PaginatorComponent $Paginator
 */
class BouclesController extends AppController {

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
		$this->Boucle->recursive = 0;
		$this->set('boucles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Boucle->exists($id)) {
			throw new NotFoundException(__('Invalid boucle'));
		}
		$options = array('conditions' => array('Boucle.' . $this->Boucle->primaryKey => $id));
		$this->set('boucle', $this->Boucle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Boucle->create();
			if ($this->Boucle->save($this->request->data)) {
				$this->Session->setFlash(__('The boucle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The boucle could not be saved. Please, try again.'));
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
		if (!$this->Boucle->exists($id)) {
			throw new NotFoundException(__('Invalid boucle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Boucle->save($this->request->data)) {
				$this->Session->setFlash(__('The boucle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The boucle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Boucle.' . $this->Boucle->primaryKey => $id));
			$this->request->data = $this->Boucle->find('first', $options);
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
		if (!$this->Boucle->exists($id)) {
			throw new NotFoundException(__('Invalid boucle'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Boucle->delete($id)) {
			$this->Session->setFlash(__('The boucle has been deleted.'));
		} else {
			$this->Flash->error(__('The boucle could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
