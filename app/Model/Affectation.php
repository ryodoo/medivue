<?php
App::uses('AppModel', 'Model');
/**
 * Affectation Model
 *
 * @property Set $Set
 * @property Specialite $Specialite
 * @property Medecin $Medecin
 * @property Composition $Composition
 */
class Affectation extends AppModel {


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
