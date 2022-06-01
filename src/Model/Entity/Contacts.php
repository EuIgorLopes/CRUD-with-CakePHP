<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Contacts extends Entity
{
    protected $_accessible = [
        "name"  => true,
        "email" => true,
        "phone" => true
    ];
}
