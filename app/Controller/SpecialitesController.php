<?php
App::uses('AppController', 'Controller');
/**
 * Specialites Controller
 *
 * @property Specialite $Specialite
 * @property PaginatorComponent $Paginator
 */
class SpecialitesController extends AppController {

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
		$this->Specialite->recursive = 0;
		$this->set('specialites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Specialite->exists($id)) {
			throw new NotFoundException(__('Invalid specialite'));
		}
		$options = array('conditions' => array('Specialite.' . $this->Specialite->primaryKey => $id));
		$this->set('specialite', $this->Specialite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Specialite->create();
			if ($this->Specialite->save($this->request->data)) {
				$this->Session->setFlash(__('The specialite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The specialite could not be saved. Please, try again.'));
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
		if (!$this->Specialite->exists($id)) {
			throw new NotFoundException(__('Invalid specialite'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Specialite->save($this->request->data)) {
				$this->Session->setFlash(__('The specialite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The specialite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Specialite.' . $this->Specialite->primaryKey => $id));
			$this->request->data = $this->Specialite->find('first', $options);
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
		if (!$this->Specialite->exists($id)) {
			throw new NotFoundException(__('Invalid specialite'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Specialite->delete($id)) {
			$this->Session->setFlash(__('The specialite has been deleted.'));
		} else {
			$this->Flash->error(__('The specialite could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
