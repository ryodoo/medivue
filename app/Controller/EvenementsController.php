<?php
App::uses('AppController', 'Controller');
/**
 * Evenements Controller
 *
 * @property Evenement $Evenement
 * @property PaginatorComponent $Paginator
 */
class EvenementsController extends AppController {

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
		$this->Evenement->recursive = 0;
		$this->set('evenements', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evenement->exists($id)) {
			throw new NotFoundException(__('Invalid evenement'));
		}
		$options = array('conditions' => array('Evenement.' . $this->Evenement->primaryKey => $id));
		$this->set('evenement', $this->Evenement->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evenement->create();
			if ($this->Evenement->save($this->request->data)) {
				$this->Session->setFlash(__('The evenement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The evenement could not be saved. Please, try again.'));
			}
		}
		$users = $this->Evenement->User->find('list');
		$compositions = $this->Evenement->Composition->find('list');
		$postes = $this->Evenement->Poste->find('list');
		$machines = $this->Evenement->Machine->find('list');
		$etapes = $this->Evenement->Etape->find('list');
		$boucles = $this->Evenement->Boucle->find('list');
		$sets = $this->Evenement->Set->find('list');
		$this->set(compact('users', 'compositions', 'postes', 'machines', 'etapes', 'boucles', 'sets'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Evenement->exists($id)) {
			throw new NotFoundException(__('Invalid evenement'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evenement->save($this->request->data)) {
				$this->Session->setFlash(__('The evenement has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The evenement could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Evenement.' . $this->Evenement->primaryKey => $id));
			$this->request->data = $this->Evenement->find('first', $options);
		}
		$users = $this->Evenement->User->find('list');
		$compositions = $this->Evenement->Composition->find('list');
		$postes = $this->Evenement->Poste->find('list');
		$machines = $this->Evenement->Machine->find('list');
		$etapes = $this->Evenement->Etape->find('list');
		$boucles = $this->Evenement->Boucle->find('list');
		$sets = $this->Evenement->Set->find('list');
		$this->set(compact('users', 'compositions', 'postes', 'machines', 'etapes', 'boucles', 'sets'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Evenement->exists($id)) {
			throw new NotFoundException(__('Invalid evenement'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Evenement->delete($id)) {
			$this->Session->setFlash(__('The evenement has been deleted.'));
		} else {
			$this->Flash->error(__('The evenement could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
