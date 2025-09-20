<?php
App::uses('AppController', 'Controller');
App::uses('OutilsController', 'Controller');

/**
 * Instruments Controller
 *
 * @property Instrument $Instrument
 * @property PaginatorComponent $Paginator
 */
class InstrumentsController extends AppController {

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
		$this->Instrument->recursive = 0;
		$this->set('instruments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Instrument->exists($id)) {
			throw new NotFoundException(__('Invalid instrument'));
		}
		$options = array('conditions' => array('Instrument.' . $this->Instrument->primaryKey => $id));
		$this->set('instrument', $this->Instrument->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Instrument->create();
			if ($this->Instrument->save($this->request->data)) {
				$this->Session->setFlash(__('The instrument has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The instrument could not be saved. Please, try again.'));
			}
		}
		$outils = new OutilsController();
		$this->request->data['Instrument']['ref'] = $outils->generatecodebar('set');
		$compositions = $this->Instrument->Composition->find('list');
		$fournisseurs = $this->Instrument->Fournisseur->find('list');
		$this->set(compact('compositions', 'fournisseurs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Instrument->exists($id)) {
			throw new NotFoundException(__('Invalid instrument'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Instrument->save($this->request->data)) {
				$this->Session->setFlash(__('The instrument has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The instrument could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Instrument.' . $this->Instrument->primaryKey => $id));
			$this->request->data = $this->Instrument->find('first', $options);
		}
		$compositions = $this->Instrument->Composition->find('list');
		$fournisseurs = $this->Instrument->Fournisseur->find('list');
		$this->set(compact('compositions', 'fournisseurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Instrument->exists($id)) {
			throw new NotFoundException(__('Invalid instrument'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Instrument->delete($id)) {
			$this->Session->setFlash(__('The instrument has been deleted.'));
		} else {
			$this->Flash->error(__('The instrument could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
