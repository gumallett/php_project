<?php

namespace model;

use phporm\Record;

/**
 * {@Table(name='room_type')}
 */
class RoomType extends Record {

    public static $__CLASS__ = __CLASS__;

    private $id;
    private $value;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value) {
        $this->value = $value;
    }


} 