<?php

namespace MVCzitto\Controller;

interface ControllerAdapter
{
    public function executable(): \Closure;
}
