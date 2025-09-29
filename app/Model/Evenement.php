<?php
App::uses('AppModel', 'Model');
/**
 * Evenement Model
 *
 * @property User $User
 * @property Composition $Composition
 * @property Poste $Poste
 * @property Machine $Machine
 * @property Etape $Etape
 * @property Boucle $Boucle
 * @property Anomaly $Anomaly
 * @property Log $Log
 */
class Evenement extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
		'Poste' => array(
			'className' => 'Poste',
			'foreignKey' => 'poste_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Machine' => array(
			'className' => 'Machine',
			'foreignKey' => 'machine_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Etape' => array(
			'className' => 'Etape',
			'foreignKey' => 'etape_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Boucle' => array(
			'className' => 'Boucle',
			'foreignKey' => 'boucle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Anomaly' => array(
			'className' => 'Anomaly',
			'foreignKey' => 'evenement_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'evenement_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
