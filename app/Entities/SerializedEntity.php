<?php

namespace App\Entities;

class SerializedEntity implements \JsonSerializable
{
    public function jsonSerialize() {
        return get_object_vars($this);
    }
}