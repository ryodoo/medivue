<?php
App::uses('AppController', 'Controller');
/**
 * Remplacements Controller
 *
 * @property Remplacement $Remplacement
 * @property PaginatorComponent $Paginator
 */
class RemplacementsController extends AppController {

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
		$this->Remplacement->recursive = 0;
		$this->set('remplacements', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Remplacement->exists($id)) {
			throw new NotFoundException(__('Invalid remplacement'));
		}
		$options = array('conditions' => array('Remplacement.' . $this->Remplacement->primaryKey => $id));
		$this->set('remplacement', $this->Remplacement->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Remplacement->create();
			if ($this->Remplacement->save($this->request->data)) {
				$this->Session->setFlash(__('The remplacement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The remplacement could not be saved. Please, try again.'));
			}
		}
		$users = $this->Remplacement->User->find('list');
		$instrumentSources = $this->Remplacement->InstrumentSource->find('list');
		$instrumentCibles = $this->Remplacement->InstrumentCible->find('list');
		$this->set(compact('users', 'instrumentSources', 'instrumentCibles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Remplacement->exists($id)) {
			throw new NotFoundException(__('Invalid remplacement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Remplacement->save($this->request->data)) {
				$this->Session->setFlash(__('The remplacement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The remplacement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Remplacement.' . $this->Remplacement->primaryKey => $id));
			$this->request->data = $this->Remplacement->find('first', $options);
		}
		$users = $this->Remplacement->User->find('list');
		$instrumentSources = $this->Remplacement->InstrumentSource->find('list');
		$instrumentCibles = $this->Remplacement->InstrumentCible->find('list');
		$this->set(compact('users', 'instrumentSources', 'instrumentCibles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Remplacement->exists($id)) {
			throw new NotFoundException(__('Invalid remplacement'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Remplacement->delete($id)) {
			$this->Session->setFlash(__('The remplacement has been deleted.'));
		} else {
			$this->Flash->error(__('The remplacement could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
