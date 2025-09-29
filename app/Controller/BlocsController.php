<?php
App::uses('AppController', 'Controller');
App::uses('OutilsController', 'Controller');

/**
 * Blocs Controller
 *
 * @property Bloc $Bloc
 * @property PaginatorComponent $Paginator
 */
class BlocsController extends AppController {

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
		$this->Bloc->recursive = 0;
		$this->set('blocs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bloc->exists($id)) {
			throw new NotFoundException(__('Invalid bloc'));
		}
		$options = array('conditions' => array('Bloc.' . $this->Bloc->primaryKey => $id));
		$this->set('bloc', $this->Bloc->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bloc->create();
			if ($this->Bloc->save($this->request->data)) {
				$this->Session->setFlash(__('The bloc has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The bloc could not be saved. Please, try again.'));
			}
		}
		$outils = new OutilsController();
		$this->request->data['Bloc']['ref'] = $outils->generatecodebar('bloc');

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bloc->exists($id)) {
			throw new NotFoundException(__('Invalid bloc'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bloc->save($this->request->data)) {
				$this->Session->setFlash(__('The bloc has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The bloc could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bloc.' . $this->Bloc->primaryKey => $id));
			$this->request->data = $this->Bloc->find('first', $options);
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
		if (!$this->Bloc->exists($id)) {
			throw new NotFoundException(__('Invalid bloc'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Bloc->delete($id)) {
			$this->Session->setFlash(__('The bloc has been deleted.'));
		} else {
			$this->Flash->error(__('The bloc could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
