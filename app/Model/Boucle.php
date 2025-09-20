<?php
App::uses('AppModel', 'Model');
/**
 * Boucle Model
 *
 * @property Evenement $Evenement
 */
class Boucle extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evenement' => array(
			'className' => 'Evenement',
			'foreignKey' => 'boucle_id',
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
