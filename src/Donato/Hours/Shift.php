<?php

namespace Donato\Hours;


class Shift
{
    protected $start;
    protected $end;

    /**
     * Shift constructor.
     * @param $start
     * @param $end
     */
    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public static function createFromStrings(\DateTime $date, $in, $out)
    {
        $shift = new Shift();

        if ($in) {
            $shift->setStart(\DateTime::createFromFormat('Y-m-d Hi', $date->format('Y-m-d ').$in));
        }

        if ($out) {
            $shift->setEnd(\DateTime::createFromFormat('Y-m-d Hi', $date->format('Y-m-d ').$out));
        }

        return $shift;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     * @return Shift
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     * @return Shift
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
}
