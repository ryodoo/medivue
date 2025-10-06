<?php
App::uses('AppModel', 'Model');
/**
 * Trempage Model
 *
 * @property Bac $Bac
 * @property User $User
 * @property Composition $Composition
 */
class Trempage extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Bac' => array(
			'className' => 'Bac',
			'foreignKey' => 'bac_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		)
	);
}
