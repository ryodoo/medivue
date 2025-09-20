<?php
App::uses('AppController', 'Controller');
/**
 * Anomalies Controller
 *
 * @property Anomaly $Anomaly
 * @property PaginatorComponent $Paginator
 */
class AnomaliesController extends AppController {

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
		$this->Anomaly->recursive = 0;
		$this->set('anomalies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Anomaly->exists($id)) {
			throw new NotFoundException(__('Invalid anomaly'));
		}
		$options = array('conditions' => array('Anomaly.' . $this->Anomaly->primaryKey => $id));
		$this->set('anomaly', $this->Anomaly->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Anomaly->create();
			if ($this->Anomaly->save($this->request->data)) {
				$this->Session->setFlash(__('The anomaly has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The anomaly could not be saved. Please, try again.'));
			}
		}
		$evenements = $this->Anomaly->Evenement->find('list');
		$typeanomalies = $this->Anomaly->Typeanomaly->find('list');
		$instruments = $this->Anomaly->Instrument->find('list');
		$this->set(compact('evenements', 'typeanomalies', 'instruments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Anomaly->exists($id)) {
			throw new NotFoundException(__('Invalid anomaly'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Anomaly->save($this->request->data)) {
				$this->Session->setFlash(__('The anomaly has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The anomaly could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Anomaly.' . $this->Anomaly->primaryKey => $id));
			$this->request->data = $this->Anomaly->find('first', $options);
		}
		$evenements = $this->Anomaly->Evenement->find('list');
		$typeanomalies = $this->Anomaly->Typeanomaly->find('list');
		$instruments = $this->Anomaly->Instrument->find('list');
		$this->set(compact('evenements', 'typeanomalies', 'instruments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Anomaly->exists($id)) {
			throw new NotFoundException(__('Invalid anomaly'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Anomaly->delete($id)) {
			$this->Session->setFlash(__('The anomaly has been deleted.'));
		} else {
			$this->Flash->error(__('The anomaly could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
