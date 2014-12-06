<?php

/**
 * Description of StickyNotesTable
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/StickyNotes/src/StickyNotes/Model/StickyNotesTable.php

namespace StickyNotes\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class StickyNotesTable extends AbstractTableGateway {

    protected $schema = 'public';
    protected $table = 'sticky_note';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('dt_created ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Entity\StickyNote();
            $entity->setId($row->sq_sticky_note)
                    ->setNote($row->ds_note)
                    ->setCreated($row->dt_created);
            $entities[] = $entity;
        }
        return $entities;
    }

    public function getStickyNote($id) {
        $row = $this->select(array('sq_sticky_note' => (int) $id))->current();
        if (!$row)
            return false;

        $stickyNote = new Entity\StickyNote(array(
                    'sq_sticky_note' => $row->sq_sticky_note,
                    'ds_note' => $row->ds_note,
                    'dt_created' => $row->dt_created,
                ));
        return $stickyNote;
    }

    public function saveStickyNote(Entity\StickyNote $stickyNote) {
        $data = array(
            'ds_note' => $stickyNote->getNote(),
            'dt_created' => $stickyNote->getCreated(),
        );

        $id = (int) $stickyNote->getId();

        if ($id == 0) {
            $data['dt_created'] = 'now()'; // date("Y-m-d H:i:s");
            try 
            {
                $result = $this->insert($data);
            } 
            catch (Exception $e) 
            {
                die($e->getMessage());
            }

            if (!$result)
                return false;

            // var_dump($this->getLastInsertValue());die;
            return $this->getLastInsertValue();
        }
        elseif ($this->getStickyNote($id)) {
            if (!$this->update($data, array('sq_sticky_note' => $id)))
                return false;
            return $id;
        }
        else
            return false;
    }

    public function removeStickyNote($id) {
        return $this->delete(array('sq_sticky_note' => (int) $id));
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

        return $row->sq_sticky_note;
    }

}