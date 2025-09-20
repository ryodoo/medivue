<?php
App::uses('AppModel', 'Model');
/**
 * Remplacement Model
 *
 * @property User $User
 * @property InstrumentSource $InstrumentSource
 * @property InstrumentCible $InstrumentCible
 */
class Remplacement extends AppModel {


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
		'InstrumentSource' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InstrumentCible' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_cible_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
