<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormBuilder
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/FormBuilder/src/FormBuilder/Model/Entity/FormBuilder.php

namespace FormBuilder\Model\Entity;

class FormBuilder {

    protected $_sq_form_builder;
    protected $_ds_name;
    protected $_dt_created;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Method');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getId() {
        return $this->_sq_form_builder;
    }

    public function setId($id) {
        $this->_sq_form_builder = $id;
        return $this;
    }

    public function getName() {
        return $this->_ds_name;
    }

    public function setName($name) {
        $this->_ds_name = $name;
        return $this;
    }

    public function getCreated() {
        return $this->_dt_created;
    }

    public function setCreated($created) {
        $this->_dt_created = $created;
        return $this;
    }

}

?>
