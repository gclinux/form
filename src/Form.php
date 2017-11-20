<?php
namespace gclinux;
class Form{
    protected $_defaultAttr=['class'=>'form-control'];
    protected $_allow_number_val = false;
    protected $_placeholder='';
    /**
     * 设置默认属性
     * @param Array|array $attr 属性数组
     * @return 对象自身
     */
    function setAttr(Array $attr=['class'=>'form-control']){
        $this->defaultAttr = $attr;
        return $this;
    }
    function allowNum($val=true){
        $this->_allow_number_val = $val;
        return $this;
    }
    /**
     * placeholder属性设置
     * @param  String $placeholder [description]
     * @return [type]              [description]
     */
    function placeholder(String $placeholder){
        $this->placeholder = $placeholder;
        return $this;
    }
    /**
     * 别称,懒得写这么长的东西
     * @param  String $ph [description]
     * @return [type]     [description]
     */
    function ph(String $ph){
        return $this->placeholder($ph);
    }

    /**
     * 创建一个select 选择框
     * @param  String      $name    选框的name属性,如果attr参数里没定义id,那么它也会充当ID
     * @param  Array       $options 选项,数组,key为值,如果是多维数组,则第一维key为分组
     * @param  string      $value   选中的值
     * @param  Array|array $attr    附加属性,不填写或者空时候为默认属性(class='form-control')可以通过setAttr来改变默认的属性.
     * @return String               HTML属性
     */
    function select(String $name,Array $options,$val='',Array $attr=[]){
        $re = '';
        $attr = $this->_attr($attr,$name);
        $re .= '<select name="'.$name.'" '.$attr.'>'."\n";
        return $re.= $this->_options($options,$val).'</select>';

    }

    private function _options(Array $options,$val,$groupName=null){
        $re='';
        $oldGroup = null;
        foreach($options as  $k=>$v){
            if(is_array($v)){
                $re .= $this->_options($v,$val,$k)."</optgroup>\n";

            }else{
                $groupName !== null and $oldGroup === null and $re .= '<optgroup label="'.$groupName.'">'."\n" and $oldGroup = $groupName  ;
                if($this->_allow_number_val){
                    $key = $k;
                }else{
                    $key = is_int($k)?$v:$k;
                }
                $select = ($key == $val)?'selected':'';
                $re .= '<option value="'.$key.'" '.$select.'>'.$v.'</option>'."\n";
                
            }
        }
        return $re;
    }

    function _attr($attr,$name,$nameAsId=true){
        $attrString='';
        if(empty($attr)){
            $attr = $this->_defaultAttr;
        }
        if($nameAsId){
            $attr['id'] = isset($attr['id']) ? $attr['id'] : $name ;
        }
        $attrString = '';
        foreach($attr as $key=>$value){
            $attrString .= $key.'="'.$value.'" ';
        }
        return $attrString;
    }

    function input(String $name,$val='',String $type="text",Array $attr=[]){
        $type = strtolower($type);
        $nameAsId = ($type != 'radio');
        $attr = $this->_attr($attr,$name,$nameAsId);
        return '<input placeholder="'.$this->_placeholder.'" type="'.$type.'" name="'.$name.'" '.$attr.' value="'.$val.'">';
    }

    function textarea(String $name,$val='',Array $attr=[]){
        $attr = $this->_attr($attr,$name,$nameAsId);
        return '<textarea name="'.$name.'" '.$attr.'>'.$val.'</textarea>';
    }


}