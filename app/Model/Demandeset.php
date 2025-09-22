<?php
App::uses('AppModel', 'Model');
/**
 * Demandeset Model
 *
 * @property Set $Set
 * @property Composition $Composition
 * @property Demande $Demande
 */
class Demandeset extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Set' => array(
			'className' => 'Set',
			'foreignKey' => 'set_id',
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
		),
		'Demande' => array(
			'className' => 'Demande',
			'foreignKey' => 'demande_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
