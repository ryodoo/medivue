<?php
App::uses('AppController', 'Controller');
/**
 * Zonesales Controller
 *
 * @property Zonesale $Zonesale
 * @property PaginatorComponent $Paginator
 */
class ZonesalesController extends AppController
{

	public function index()
	{
		$this->Zonesale->recursive = 0;
		$this->set('zonesales', $this->Zonesale->find('all'));
	}

	public function view($id = null)
	{
		if (!$this->Zonesale->exists($id)) {
			throw new NotFoundException(__('Invalid zonesale'));
		}
		$options = array('conditions' => array('Zonesale.' . $this->Zonesale->primaryKey => $id));
		$this->set('zonesale', $this->Zonesale->find('first', $options));
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$this->Zonesale->recursive = -1;
			$zone = $this->Zonesale->find('first', array('conditions' => array('Zonesale.poste_id' => $this->request->data['Zonesale']['poste_id'], "Zonesale.etat" => "En cours")));
			if (empty($zone)) {
				$this->Zonesale->create();
				$this->Zonesale->save($this->request->data);
				$this->Session->setFlash(__('Scané un instriment ou un kit pour l\'ajouter en zone sale'));
				return $this->redirect(array('action' => 'camera', $this->Zonesale->id));
			} else {
				$this->Session->setFlash(__('Scané un instriment ou un kit pour l\'ajouter en zone sale'));
				return $this->redirect(array('action' => 'camera', $zone['Zonesale']['id']));
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
		if (!$this->Zonesale->exists($id)) {
			throw new NotFoundException(__('Invalid zonesale'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zonesale->save($this->request->data)) {
				$this->Session->setFlash(__('The zonesale has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zonesale could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Zonesale.' . $this->Zonesale->primaryKey => $id));
			$this->request->data = $this->Zonesale->find('first', $options);
		}
		$postes = $this->Zonesale->Poste->find('list');
		$users = $this->Zonesale->User->find('list');
		$this->set(compact('postes', 'users'));
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
		if (!$this->Zonesale->exists($id)) {
			throw new NotFoundException(__('Invalid zonesale'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Zonesale->delete($id)) {
			$this->Session->setFlash(__('The zonesale has been deleted.'));
		} else {
			$this->Session->setFlash(__('The zonesale could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



	function camera($id = null)
	{
		if (!$this->Zonesale->exists($id)) {
			throw new NotFoundException(__('Invalid zonesale'));
		}
		$zonesale = $this->Zonesale->Zonesaledetail->find('all', array('conditions' => array('Zonesale.id' => $id)));
		debug($zonesale);exit();

		$this->loadModel("Trempage");
		$this->loadModel("Instrument");
		$this->Instrument->recursive = -1;
		$compositions = $this->Trempage->find('all', array('fields' => array('Composition.id', 'Composition.name'), 'conditions' => array('Trempage.etat' => 'En cours')));
		foreach ($compositions as $key => $composition) {
			$compositions[$key]['Composition']['Instrument'] = $this->Instrument->find('all', array('conditions' => array('Instrument.composition_id' => $composition['Composition']['id'])));
		}
		$this->set('compositions', $compositions);
		$this->set('zonesale', $zonesale);
	}



	function scan_camera($zonesale_id,$ref = null)
	{
		$this->loadModel("Instrument");
		$this->loadModel("Composition");
		$instrument = $this->Instrument->find('first', array("fields" => array("Instrument.id", "Composition.code"), 'conditions' => array('Instrument.ref' => $ref)));
		if ($instrument) 
		{
			$ref = $instrument["Composition"]["code"];
			/*$d=[];
			$d['ZonesaleDetail']['zonesale_id']=$zonesale_id;
			$d['ZonesaleDetail']['instrument_id']=$instrument["Instrument"]["id"];
			$this->loadModel("ZonesaleDetail");
			$this->ZonesaleDetail->create();
			$this->ZonesaleDetail->save($d);*/
		}
		$composition = $this->Composition->find('first', array('conditions' => array('Composition.code' => $ref)));
		if($composition){
			return $composition;
		} else {
			return null;
		}

	}
}
