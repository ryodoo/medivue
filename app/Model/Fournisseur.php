<?php
App::uses('AppModel', 'Model');
/**
 * Fournisseur Model
 *
 * @property Composition $Composition
 * @property Instrument $Instrument
 * @property Set $Set
 */
class Fournisseur extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Composition' => array(
			'className' => 'Composition',
			'foreignKey' => 'fournisseur_id',
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
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'fournisseur_id',
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
