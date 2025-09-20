<?php
App::uses('AppController', 'Controller');
App::uses('OutilsController', 'Controller');
/**
 * Compositions Controller
 *
 * @property Composition $Composition
 * @property PaginatorComponent $Paginator
 */
class CompositionsController extends AppController
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
		$this->Composition->recursive = 0;
		$this->set('compositions', $this->Paginator->paginate());
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
		if (!$this->Composition->exists($id)) {
			throw new NotFoundException(__('Invalid composition'));
		}
		$options = array('conditions' => array('Composition.' . $this->Composition->primaryKey => $id));
		$this->set('composition', $this->Composition->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Composition->create();
			if ($this->Composition->save($this->request->data)) {
				$this->Session->setFlash(__('The composition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The composition could not be saved. Please, try again.'));
			}
		}
		$outils = new OutilsController();
		$this->request->data['Composition']['ref'] = $outils->generatecodebar('set');
		$fournisseurs = $this->Composition->Fournisseur->find('list');
		$sets = $this->Composition->Set->find('list');
		$this->set(compact('fournisseurs', 'sets'));
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
		if (!$this->Composition->exists($id)) {
			throw new NotFoundException(__('Invalid composition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Composition->save($this->request->data)) {
				$this->Session->setFlash(__('The composition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The composition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Composition.' . $this->Composition->primaryKey => $id));
			$this->request->data = $this->Composition->find('first', $options);
		}
		$fournisseurs = $this->Composition->Fournisseur->find('list');
		$sets = $this->Composition->Set->find('list');
		$this->set(compact('fournisseurs', 'sets'));
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
		if (!$this->Composition->exists($id)) {
			throw new NotFoundException(__('Invalid composition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Composition->delete($id)) {
			$this->Session->setFlash(__('The composition has been deleted.'));
		} else {
			$this->Flash->error(__('The composition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
