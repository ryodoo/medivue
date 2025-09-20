<?php
App::uses('AppController', 'Controller');
/**
 * Machines Controller
 *
 * @property Machine $Machine
 * @property PaginatorComponent $Paginator
 */
class MachinesController extends AppController {

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
		$this->Machine->recursive = 0;
		$this->set('machines', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Machine->exists($id)) {
			throw new NotFoundException(__('Invalid machine'));
		}
		$options = array('conditions' => array('Machine.' . $this->Machine->primaryKey => $id));
		$this->set('machine', $this->Machine->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Machine->create();
			if ($this->Machine->save($this->request->data)) {
				$this->Session->setFlash(__('The machine has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The machine could not be saved. Please, try again.'));
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
		if (!$this->Machine->exists($id)) {
			throw new NotFoundException(__('Invalid machine'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Machine->save($this->request->data)) {
				$this->Session->setFlash(__('The machine has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The machine could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Machine.' . $this->Machine->primaryKey => $id));
			$this->request->data = $this->Machine->find('first', $options);
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
		if (!$this->Machine->exists($id)) {
			throw new NotFoundException(__('Invalid machine'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Machine->delete($id)) {
			$this->Session->setFlash(__('The machine has been deleted.'));
		} else {
			$this->Flash->error(__('The machine could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
