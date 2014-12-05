<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StickyNote
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/Entity/StickyNotes.php

namespace StickyNotes\Model\Entity;

class StickyNote {

    protected $_sq_sticky_note;
    protected $_ds_note;
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
        return $this->_sq_sticky_note;
    }

    public function setId($id) {
        $this->_sq_sticky_note = $id;
        return $this;
    }

    public function getNote() {
        return $this->_ds_note;
    }

    public function setNote($note) {
        $this->_ds_note = $note;
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
