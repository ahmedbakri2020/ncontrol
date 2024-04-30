<?php
//print_r($_POST); die();
$i = 0;
$date = date('Y-m-d');
$rashi = array('mesh', 'brish', 'mithun', 'karkat', 'singha', 'kanya', 'tula', 'brishick', 'dhanu', 'makar', 'kumbha', 'min');
$obj->tbl = 'r01rashifal';
$obj->val = array('mesh' => $_POST['mesh'],
    'brish' => $_POST['brish'],
    'mithun' => $_POST['mithun'],
    'karkat' => $_POST['karkat'],
    'singha' => $_POST['singha'],
    'kanya' => $_POST['kanya'],
    'tula' => $_POST['tula'],
    'brishick' => $_POST['brishick'],
    'dhanu' => $_POST['dhanu'],
    'makar' => $_POST['makar'],
    'kumbha' => $_POST['kumbha'],
    'min' => $_POST['min'],
    'r01desc'=>$_POST['desc'],
    'posted_on' => $date,
);

$obj->cond = array('uin' => 1);
$obj->update();
$obj->redirect('?page=rashifal&id=1');


