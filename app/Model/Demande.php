<?php
App::uses('AppModel', 'Model');
/**
 * Demande Model
 *
 * @property User $User
 * @property Specialite $Specialite
 * @property Medecin $Medecin
 * @property Demandeset $Demandeset
 */
class Demande extends AppModel {


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
		'Specialite' => array(
			'className' => 'Specialite',
			'foreignKey' => 'specialite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Medecin' => array(
			'className' => 'Medecin',
			'foreignKey' => 'medecin_id',
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
		'Demandeset' => array(
			'className' => 'Demandeset',
			'foreignKey' => 'demande_id',
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
