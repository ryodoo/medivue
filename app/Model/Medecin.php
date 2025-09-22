<?php
App::uses('AppModel', 'Model');
/**
 * Medecin Model
 *
 * @property Affectation $Affectation
 */
class Medecin extends AppModel {


	public $displayField = 'name';

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'medecin_id',
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
