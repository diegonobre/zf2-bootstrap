<?php

/**
 * Description of FormBuilderTable
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/FormBuilder/src/FormBuilder/Model/FormBuilderTable.php

namespace FormBuilder\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class FormBuilderTable extends AbstractTableGateway {

    protected $table = 'prototype.form_builder';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->table = new \Zend\Db\Sql\TableIdentifier('form_builder', 'prototype');
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('dt_created ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\FormBuilder();
            $entity->setId($row->sq_form_builder)
                    ->setName($row->ds_name)
                    ->setCreated($row->dt_created);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getFormBuilder($id) {
        var_dump($id);die;
        $row = $this->select(array('sq_form_builder' => (int) $id))->current();
        if (!$row)
            return false;

        $formBuilder = new Entity\FormBuilder(array(
                    'id' => $row->sq_form_builder,
                    'name' => $row->ds_name,
                    'created' => $row->dt_created,
                ));
        return $formBuilder;
    }

    public function saveFormBuilder(Entity\FormBuilder $formBuilder) {
        $data = array(
            'ds_name' => $formBuilder->getName(),
            'dt_created' => $formBuilder->getCreated(),
        );

        $id = (int) $formBuilder->getId();

        if ($id == 0) {
            $data['dt_created'] = 'now()';
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        elseif ($this->getFormBuilder($id)) {
            if (!$this->update($data, array('sq_form_builder' => $id)))
                return false;
            return $id;
        }
        else
            return false;
    }

    public function removeFormBuilder($id) {
        return $this->delete(array('sq_form_builder' => (int) $id));
    }

    /**
     * Override getLastInsertValue from AbstractTableGateway
     * I can't do it using the default for PostgreSQL
     */
    public function getLastInsertValue() {
        $row = $this->select(function (Select $select) {
                        $select->order('dt_created DESC');
                        $select->limit(1);
                    })->current();

        if (!$row)
            return false;

        return $row->sq_form_builder;
    }

}