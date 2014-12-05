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

    protected $table = 'formbuilder';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('created ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\FormBuilder();
            $entity->setId($row->id)
                    ->setName($row->name)
                    ->setCreated($row->created);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getFormBuilder($id) {
        $row = $this->select(array('id' => (int) $id))->current();
        if (!$row)
            return false;

        $formBuilder = new Entity\FormBuilder(array(
                    'id' => $row->id,
                    'name' => $row->name,
                    'created' => $row->created,
                ));
        return $formBuilder;
    }

    public function saveFormBuilder(Entity\FormBuilder $formBuilder) {
        $data = array(
            'name' => $formBuilder->getName(),
            'created' => $formBuilder->getCreated(),
        );

        $id = (int) $formBuilder->getId();

        if ($id == 0) {
            $data['created'] = date("Y-m-d H:i:s");
            if (!$this->insert($data))
                return false;
            return $this->getLastInsertValue();
        }
        elseif ($this->getFormBuilder($id)) {
            if (!$this->update($data, array('id' => $id)))
                return false;
            return $id;
        }
        else
            return false;
    }

    public function removeFormBuilder($id) {
        return $this->delete(array('id' => (int) $id));
    }

}