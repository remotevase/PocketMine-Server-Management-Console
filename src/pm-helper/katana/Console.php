<?php

namespace pm-helper\katana;

use pm-helper\Terminal;


class Console extends KatanaModule
{
    public function init()
    {
        parent::setName("console");
        parent::writeLoaded();
    }

}
