<?php
App::uses('AppController', 'Controller');
/**
 * Affectations Controller
 *
 * @property Affectation $Affectation
 * @property PaginatorComponent $Paginator
 */
class AffectationsController extends AppController {

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
		$this->Affectation->recursive = 0;
		$this->set('affectations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
		$this->set('affectation', $this->Affectation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Affectation->create();
			if ($this->Affectation->save($this->request->data)) {
				$this->Session->setFlash(__('The affectation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The affectation could not be saved. Please, try again.'));
			}
		}
		$specialites = $this->Affectation->Specialite->find('list');
		$medecins = $this->Affectation->Medecin->find('list');
		$compositions = $this->Affectation->Composition->find('list');
		$this->set(compact('specialites', 'medecins', 'compositions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Affectation->save($this->request->data)) {
				$this->Session->setFlash(__('The affectation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The affectation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
			$this->request->data = $this->Affectation->find('first', $options);
		}
		$specialites = $this->Affectation->Specialite->find('list');
		$medecins = $this->Affectation->Medecin->find('list');
		$compositions = $this->Affectation->Composition->find('list');
		$this->set(compact('specialites', 'medecins', 'compositions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Affectation->delete($id)) {
			$this->Session->setFlash(__('The affectation has been deleted.'));
		} else {
			$this->Flash->error(__('The affectation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
