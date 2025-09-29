<?php
App::uses('AppModel', 'Model');
/**
 * Demandecomposition Model
 *
 * @property Demande $Demande
 * @property Composition $Composition
 */
class Demandecomposition extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Demande' => array(
			'className' => 'Demande',
			'foreignKey' => 'demande_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Composition' => array(
			'className' => 'Composition',
			'foreignKey' => 'composition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
