<?php

abstract class BaseFormDoctrine extends ahBaseFormDoctrine
{
    public function setup()
    {
        parent::setup();
        
        unset($this['created_at'], $this['updated_at'], $this['slug'], $this['position']);
    }
}
