## intuition

一个非常简单的php表单输入框生成类,我自己主要是写来解决tp5模版生成表单不友好的问题.当然其他地方都可以用的.

#### install:

本类支持composer直接安装

```shell
composer require gclinux/form
```



#### how to use:



```php
$f = new gclinux\form();

$f->input('my-name','Joffe');
//<input name="my-name" class="form-control" id="my-name">

//setAttr will effect the default attr.
$f->setAttr('class'=>'AA')->input('my-name','Joffe');
$f->input('my-name2','Joffe');
//<input name="my-name" class="AA" id="my-name">
//<input name="my-name2" class="AA" id="my-name2">

$f->input('my-name','Joffe','passwd',[class=>'pass','test'=>""]);
//<input name="my-name" class="pass" id="my-name" test="">

$f->select('simple-select',['a','b','c','d'=>'E'],'b');
/**
<select name="simple-select" class="form-control" id="simple-select" >
<option value="a" >a</option>
<option value="b" selected>b</option>
<option value="c" >c</option>
<option value="d" >E</option>
</select>
**/
//group selectd
$f->select('group-select',['group_A'=>['a','b','c'],'group_B'=>['a1'=>'A','b1'=>'B']],'b');
/*
<select name="group-select" class="form-control" id="group-select" >
<optgroup label="group_A">
<option value="a" >a</option>
<option value="b" selected>b</option>
<option value="c" >c</option>
</optgroup>
<optgroup label="group_B">
<option value="a1" >A</option>
<option value="b1" >B</option>
</optgroup>
</select>
*/

//complex select
$f->select('test',
	[
	'test'=>9,
	'group'=>['a'=>'A','b'=>'B','C','D'],
	'E','f'=>'F',
	'number_group'=>['1','CC','NUMC'=>['a9','a10']],
	'ccc'
	]
	,'C');
/*
<select name="test" class="form-control" id="test" >
<option value="test" >9</option>
<optgroup label="group">
<option value="a" >A</option>
<option value="b" >B</option>
<option value="C" selected>C</option>
<option value="D" >D</option>
</optgroup>
<option value="E" >E</option>
<option value="f" >F</option>
<optgroup label="number_group">
<option value="1" >1</option>
<option value="CC" >CC</option>
<optgroup label="NUMC">
<option value="a9" >a9</option>
<option value="a10" >a10</option>
</optgroup>
</optgroup>
<option value="ccc" >ccc</option>
</select>
*/

//textarea
$f->textarea('name','the value');

```
## 在thinkphp里面使用
安装后
composer require gclinux/form

在需要用的模版上 例如 view/index/index.html 里
```
{~$f = new \gclinux\Form()}
{:$f->input('test','')}
```

