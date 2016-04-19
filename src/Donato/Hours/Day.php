<?php

namespace Donato\Hours;

class Day
{
    /** @var \DateTime */
    protected $date;

    /** @var string */
    protected $obs1;

    /** @var string */
    protected $obs2;

    /** @var array */
    protected $shifts = [];

    /**
     * Day constructor.
     * @param \DateTime $date
     * @param string $obs1
     * @param string $obs2
     */
    public function __construct(\DateTime $date = null, $obs1 = null, $obs2 = null)
    {
        $this->date = $date;
        $this->obs1 = $obs1;
        $this->obs2 = $obs2;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Day
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getObs1()
    {
        return $this->obs1;
    }

    /**
     * @param string $obs1
     * @return Day
     */
    public function setObs1($obs1)
    {
        $this->obs1 = $obs1;

        return $this;
    }

    /**
     * @return string
     */
    public function getObs2()
    {
        return $this->obs2;
    }

    /**
     * @param string $obs2
     * @return Day
     */
    public function setObs2($obs2)
    {
        $this->obs2 = $obs2;

        return $this;
    }

    /**
     * @return array
     */
    public function getShifts()
    {
        return $this->shifts;
    }

    /**
     * @param array $shifts
     * @return Day
     */
    public function setShifts($shifts)
    {
        $this->shifts = $shifts;

        return $this;
    }

    /**
     * @param Shift $shift
     * @return Day
     */
    public function addShift(Shift $shift)
    {
        $this->shifts[] = $shift;

        return $this;
    }
}
