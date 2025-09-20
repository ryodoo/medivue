<?php
App::uses('AppModel', 'Model');
/**
 * Specialite Model
 *
 * @property Affectation $Affectation
 */
class Specialite extends AppModel {

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
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'specialite_id',
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
