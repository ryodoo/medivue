<?php
App::uses('AppController', 'Controller');
App::uses('OutilsController', 'Controller');
/**
 * Sets Controller
 *
 * @property Set $Set
 * @property PaginatorComponent $Paginator
 */
class SetsController extends AppController
{

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
	public function index()
	{
		$this->Set->recursive = 0;
		$this->set('sets', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		if (!$this->Set->exists($id)) {
			throw new NotFoundException(__('Invalid set'));
		}
		$options = array('conditions' => array('Set.' . $this->Set->primaryKey => $id));
		$this->set('set', $this->Set->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) 
		{
			$this->Set->create();
			if ($this->Set->save($this->request->data)) {
				$this->Session->setFlash(__('The set has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The set could not be saved. Please, try again.'));
			}
		}
		$outils = new OutilsController();
		$this->request->data['Set']['ref'] = $outils->generatecodebar('set');
		$fournisseurs = $this->Set->Fournisseur->find('list');
		$this->set(compact('fournisseurs'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null)
	{
		if (!$this->Set->exists($id)) {
			throw new NotFoundException(__('Invalid set'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Set->save($this->request->data)) {
				$this->Session->setFlash(__('The set has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The set could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Set.' . $this->Set->primaryKey => $id));
			$this->request->data = $this->Set->find('first', $options);
		}
		$fournisseurs = $this->Set->Fournisseur->find('list');
		$this->set(compact('fournisseurs'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		if (!$this->Set->exists($id)) {
			throw new NotFoundException(__('Invalid set'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Set->delete($id)) {
			$this->Session->setFlash(__('The set has been deleted.'));
		} else {
			$this->Flash->error(__('The set could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
