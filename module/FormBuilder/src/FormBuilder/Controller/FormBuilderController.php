<?php

/**
 * Description of FormBuilderController
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
// module/FormBuilder/src/FormBuilder/Controller/FormBuilderController.php:

namespace FormBuilder\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FormBuilderController extends AbstractActionController {

    protected $_FormBuilderTable;

    public function indexAction() {
        return new ViewModel(array(
                    'formbuilders' => $this->getFormBuilderTable()->fetchAll(),
                ));
    }

    public function addAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $new_note = new \FormBuilder\Model\Entity\FormBuilder();
            if (!$note_id = $this->getFormBuilderTable()->saveFormBuilder($new_note))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true, 'new_note_id' => $note_id)));
            }
        }
        return $response;
    }

    public function removeAction() {
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            if (!$this->getFormBuilderTable()->removeFormBuilder($note_id))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function updateAction() {
        // update post
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->isPost()) {
            $post_data = $request->getPost();
            $note_id = $post_data['id'];
            $note_content = $post_data['name'];
            $formbuilder = $this->getFormBuilderTable()->getFormBuilder($note_id);
            $formbuilder->setName($note_content);
            if (!$this->getFormBuilderTable()->saveFormBuilder($formbuilder))
                $response->setContent(\Zend\Json\Json::encode(array('response' => false)));
            else {
                $response->setContent(\Zend\Json\Json::encode(array('response' => true)));
            }
        }
        return $response;
    }

    public function getFormBuilderTable() {
        if (!$this->_FormBuilderTable) {
            $sm = $this->getServiceLocator();
            $this->_FormBuilderTable = $sm->get('FormBuilder\Model\FormBuilderTable');
        }
        return $this->_FormBuilderTable;
    }

}