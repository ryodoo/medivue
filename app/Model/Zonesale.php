<?php
App::uses('AppModel', 'Model');
/**
 * Zonesale Model
 *
 * @property Poste $Poste
 * @property User $User
 * @property Zonesaledetail $Zonesaledetail
 */
class Zonesale extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Poste' => array(
			'className' => 'Poste',
			'foreignKey' => 'poste_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Zonesaledetail' => array(
			'className' => 'Zonesaledetail',
			'foreignKey' => 'zonesale_id',
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
