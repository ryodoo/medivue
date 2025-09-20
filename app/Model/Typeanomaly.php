<?php
App::uses('AppModel', 'Model');
/**
 * Typeanomaly Model
 *
 * @property Anomaly $Anomaly
 */
class Typeanomaly extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Anomaly' => array(
			'className' => 'Anomaly',
			'foreignKey' => 'typeanomaly_id',
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
