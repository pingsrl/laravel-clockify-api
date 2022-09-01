<?php

namespace Ping\LaravelClockifyApi\Traits;

use Carbon\Carbon;

trait HasTimes
{
    protected Carbon $dateRangeStart;

    protected Carbon $dateRangeEnd;

    public function from(Carbon $fromDate)
    {
        $this->dateRangeStart = $fromDate;

        return $this;
    }

    public function to(Carbon $endDate)
    {
        $this->dateRangeEnd = $endDate;

        return $this;
    }
}
