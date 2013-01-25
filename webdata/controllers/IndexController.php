<?php

class IndexController extends Pix_Controller
{
    public function indexAction()
    {
    }

    public function showAction()
    {
        list(, /*id*/, $id) = explode('/', $this->getURI());

        if (!$unit = Unit::find(intval($id))) {
            return $this->redirect('/');
        }

        $this->view->unit = $unit;
    }

    public function nameAction()
    {
        list(, /*name*/, $name) = explode('/', $this->getURI());

        $name = urldecode($name);
        if (!$namemap = NameMap::search(array('name' => $name))->first()) {
            $unit_ids = array();
        } else {
            $unit_ids = NameTable::search(array('name_id' => $namemap->id))->toArray('unit_id');
        }
        $this->view->unit_ids = $unit_ids;
        $this->view->name = $name;
    }
}