<?php
App::uses('AppController', 'Controller');
/**
 * Devs Controller
 *
 * @property Dev $Dev
 * @property PaginatorComponent $Paginator
 */
class DevsController extends AppController
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
		$this->Dev->recursive = 0;
		$this->set('devs', $this->Paginator->paginate());
	}



	function get($controller, $view)
	{
		$dev = $this->Dev->find('all', array('conditions' => array('Dev.controller' => $controller, 'Dev.view' => $view), 'order' => array('Dev.created' => 'DESC')));
		return $dev;
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
		if (!$this->Dev->exists($id)) {
			throw new NotFoundException(__('Invalid dev'));
		}
		$options = array('conditions' => array('Dev.' . $this->Dev->primaryKey => $id));
		$this->set('dev', $this->Dev->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Dev->create();
			if ($this->Dev->save($this->request->data)) {
				$this->Session->setFlash(__('The dev has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The dev could not be saved. Please, try again.'));
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
		if (!$this->Dev->exists($id)) {
			throw new NotFoundException(__('Invalid dev'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dev->save($this->request->data)) {
				$this->Session->setFlash(__('The dev has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The dev could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dev.' . $this->Dev->primaryKey => $id));
			$this->request->data = $this->Dev->find('first', $options);
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
		if (!$this->Dev->exists($id)) {
			throw new NotFoundException(__('Invalid dev'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dev->delete($id)) {
			$this->Session->setFlash(__('The dev has been deleted.'));
		} else {
			$this->Flash->error(__('The dev could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
