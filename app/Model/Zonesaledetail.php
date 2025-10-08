<?php
App::uses('AppModel', 'Model');
/**
 * Zonesaledetail Model
 *
 * @property Zonesale $Zonesale
 * @property Composition $Composition
 * @property Instrument $Instrument
 */
class Zonesaledetail extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Zonesale' => array(
			'className' => 'Zonesale',
			'foreignKey' => 'zonesale_id',
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
