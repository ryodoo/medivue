<?php
App::uses('AppModel', 'Model');
/**
 * Demande Model
 *
 * @property User $User
 * @property Bloc $Bloc
 * @property Specialite $Specialite
 * @property Medecin $Medecin
 * @property Demandecomposition $Demandecomposition
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
		'Bloc' => array(
			'className' => 'Bloc',
			'foreignKey' => 'bloc_id',
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
		'Demandecomposition' => array(
			'className' => 'Demandecomposition',
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
