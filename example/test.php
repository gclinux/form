<?php
include "../src/Form.php";
$form = new gclinux\Form();

echo $form->select('simple-select',['a','b','c'],'b');
echo $form->select('group-select',['group_A'=>['a','b','c'],'group_B'=>['a1'=>'A','b1'=>'B']],'b');
echo $form->select('test',
	[
	'test'=>9,
	'group'=>['a'=>'A','b'=>'B','C','D'],
	'E','f'=>'F',
	'number_group'=>['1','CC','NUMC'=>['a9','a10']],
	'ccc'
	]
	,'C');
echo "<br>";
echo $form->input('test2','text');
echo "<br>";
echo $form->input('passwd','my passwd','password',['class'=>'a input class password','other'=>'test']);