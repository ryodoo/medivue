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

	public function add2() {
		$this->layout = false;

		if ($this->request->is('post')) {
			// Handle image upload
			if (!empty($this->request->data['Instrument']['image_file']['name'])) {
				$file = $this->request->data['Instrument']['image_file'];
				$fileName = time() . '_' . $file['name'];
				$uploadPath = WWW_ROOT . 'files' . DS . $fileName;

				if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
					// Store the relative path in the database
					$this->request->data['Instrument']['image'] = 'files/' . $fileName;
				} else {
					$this->Flash->error(__('Error uploading image.'));
				}

				// Remove the file input from data to avoid saving it
				unset($this->request->data['Instrument']['image_file']);
			}

			$this->Instrument->create();
			if ($this->Instrument->save($this->request->data)) {
				$this->Session->setFlash(__('The instrument has been saved.'));

				// Return JSON response for AJAX
				if ($this->request->is('ajax')) {
					$this->autoRender = false;
					echo json_encode(array('success' => true, 'message' => 'Instrument saved successfully'));
					return;
				}

				return $this->redirect(array('action' => 'index'));
			} else {
				// Return JSON error for AJAX
				if ($this->request->is('ajax')) {
					$this->autoRender = false;
					$this->response->statusCode(400);
					echo json_encode(array('success' => false, 'message' => 'Could not save instrument'));
					return;
				}

				$this->Flash->error(__('The instrument could not be saved. Please, try again.'));
			}
		}

		$outils = new OutilsController();
		$this->request->data['Instrument']['ref'] = $outils->generatecodebar('set');
		$compositions = $this->Instrument->Composition->find('list');
		$fournisseurs = $this->Instrument->Fournisseur->find('list');
		$this->set(compact('compositions', 'fournisseurs'));
	}


	public function getFournisseurs() {
		// Important: Configure the view to return JSON
		$this->layout = 'ajax';
		$this->autoRender = false;

		// Set proper headers for JSON
		$this->response->type('json');
		header('Content-Type: application/json');

		try {
			$fournisseurs = $this->Instrument->Fournisseur->find('all', array(
				'fields' => array('Fournisseur.id', 'Fournisseur.name'),
				'order' => array('Fournisseur.name' => 'ASC'),
				'recursive' => -1
			));

			// Format data for autocomplete
			$result = array();
			foreach ($fournisseurs as $fournisseur) {
				$result[] = array(
					'id' => $fournisseur['Fournisseur']['id'],
					'name' => $fournisseur['Fournisseur']['name']
				);
			}

			echo json_encode($result);
		} catch (Exception $e) {
			echo json_encode(array('error' => $e->getMessage()));
		}

		return;
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
