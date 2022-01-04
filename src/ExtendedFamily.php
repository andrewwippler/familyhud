<?php

namespace HUD;
use ICanBoogie\DateTime;

class ExtendedFamily
{

    protected $timezone = '';
    protected $name = '';
    protected $call_begin = '';
    protected $call_end = '';


    function __construct(array $array)
    {
        $this->timezone = $array['timezone'];
        $this->name = $array['name'];
        $this->call_begin = $array['call_begin'];
        $this->call_end = $array['call_end'];
    }

    public function can_call()
    {
        $current_time = new DateTime('now', $this->timezone);
        $compare_time = $current_time->as_time;

        // var_dump($this->call_begin < $compare_time);
        // var_dump($this->call_end > $compare_time);
        // echo $compare_time . PHP_EOL;

        if ($this->call_begin < $compare_time && $this->call_end > $compare_time)
        {

            return true;
        }
        
        return false;
    }

    public function name()
    {
        return $this->name;
    }
}
