<?php

namespace td1\vue;

class VueParticipant
{
    private $data;
    private $container;

    public function __construct(array $data, $c)
    {
        $this->data = $data;
        $this->container = $c;
    }

    public function question1() {
        $l = $this->data[0];
        if(is_null($l))
        {
            return "<h2>Liste Inexistante</h2>";
        }
        return json_encode($l, JSON_PRETTY_PRINT);
    }
}