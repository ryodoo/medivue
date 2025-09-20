<?php
App::uses('AppModel', 'Model');
/**
 * Set Model
 *
 * @property Fournisseur $Fournisseur
 * @property Affectation $Affectation
 * @property Composition $Composition
 * @property Evenement $Evenement
 */
class Set extends AppModel {

	public $displayField = 'nom';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Fournisseur' => array(
			'className' => 'Fournisseur',
			'foreignKey' => 'fournisseur_id',
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
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'set_id',
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
		'Composition' => array(
			'className' => 'Composition',
			'foreignKey' => 'set_id',
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
		'Evenement' => array(
			'className' => 'Evenement',
			'foreignKey' => 'set_id',
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
