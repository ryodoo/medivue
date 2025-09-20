<?php
App::uses('AppModel', 'Model');
/**
 * Anomaly Model
 *
 * @property Evenement $Evenement
 * @property Typeanomaly $Typeanomaly
 * @property Instrument $Instrument
 */
class Anomaly extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Evenement' => array(
			'className' => 'Evenement',
			'foreignKey' => 'evenement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Typeanomaly' => array(
			'className' => 'Typeanomaly',
			'foreignKey' => 'typeanomaly_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
