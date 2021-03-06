<?php

namespace Zee\DateRange\States;

use DateTimeInterface;
use Zee\DateRange\DateRangeException;

/**
 * State of the finite range.
 */
final class FiniteState extends RangeState
{
    /**
     * @var DateTimeInterface
     */
    private $startDate;

    /**
     * @var DateTimeInterface
     */
    private $endDate;

    /**
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     */
    public function __construct(DateTimeInterface $startDate, DateTimeInterface $endDate)
    {
        if ($endDate <= $startDate) {
            throw new DateRangeException('Invalid end date, must be after start');
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function hasStartDate(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function hasEndDate(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(DateTimeInterface $start): RangeState
    {
        return new FiniteState($start, $this->endDate);
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate(DateTimeInterface $end): RangeState
    {
        return new FiniteState($this->startDate, $end);
    }
}
