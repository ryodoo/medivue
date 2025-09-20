<?php

App::uses('AppController', 'Controller');
class OutilsController extends AppController
{
    function generatecodebar($type='set')
    {
        if($type=='set')
            $code=1;
        elseif($type=='composition')
            $code=2;
        else
            $code=3;
        $this->loadModel('Config');
        $config = $this->Config->find('first');
        $codebar_start=10;
        if($config && isset($config['Config']['sufixe_codebar']))
            $codebar_start=$config['Config']['sufixe_codebar'];
        // Générer un code interne
        $code = $codebar_start.$code . date("ymdHis");

        // Calcul clé de contrôle (comme EAN)
        $sum = 0;
        for ($i = 0; $i < strlen($code); $i++) {
            $digit = (int) $code[$i];
            $sum += (($i % 2) ? $digit * 3 : $digit);
        }
        $check = (10 - ($sum % 10)) % 10;

        return $code . $check;
    }

}