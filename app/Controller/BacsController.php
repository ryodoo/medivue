<?php
App::uses('AppController', 'Controller');
/**
 * Bacs Controller
 *
 * @property Bac $Bac
 * @property PaginatorComponent $Paginator
 */
class BacsController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->Bac->recursive = 0;
		$this->set('bacs', $this->Bac->find('all'));
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
		if (!$this->Bac->exists($id)) {
			throw new NotFoundException(__('Invalid bac'));
		}
		$options = array('conditions' => array('Bac.' . $this->Bac->primaryKey => $id));
		$this->set('bac', $this->Bac->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Bac->create();
			if ($this->Bac->save($this->request->data)) {
				$this->Session->setFlash(__('The bac has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bac could not be saved. Please, try again.'));
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
	public function edit($id = null)
	{
		if (!$this->Bac->exists($id)) {
			throw new NotFoundException(__('Invalid bac'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bac->save($this->request->data)) {
				$this->Session->setFlash(__('The bac has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bac could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bac.' . $this->Bac->primaryKey => $id));
			$this->request->data = $this->Bac->find('first', $options);
		}
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
		if (!$this->Bac->exists($id)) {
			throw new NotFoundException(__('Invalid bac'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Bac->delete($id)) {
			$this->Session->setFlash(__('The bac has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bac could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
