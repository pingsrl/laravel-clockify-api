<?php

namespace Ping\LaravelClockifyApi\Reports;

class ClockifyDetailedReport extends ClockifyReport
{
    protected string $endpoint = '/reports/detailed';

    protected function requestData()
    {
        return $this->filter((array) [
            'dateRangeStart' => $this->dateRangeStart,
            'dateRangeEnd' => $this->dateRangeEnd,
            'detailedFilter' => [
                'page' => $this->page,
                'pageSize' => $this->pageSize,
                'sortColumn' => 'DATE',
            ],
            $this->mergeWhen('' !== $this->sortOrder, [
                'sortOrder' => $this->sortOrder,
            ]),
            $this->mergeWhen(!is_null($this->userIds), [
                'users' => [
                    'ids' => $this->userIds,
                    'contains' => 'CONTAINS',
                    'status' => 'ALL',
                ],
            ]),
            $this->mergeWhen(!is_null($this->tagIds), [
                'tags' => [
                    'ids' => $this->tagIds,
                    'containedInTimeentry' => $this->tagsContainedInTimeentry,
                    'status' => 'ALL',
                ],
            ]),
            $this->mergeWhen(!is_null($this->taskIds), [
                'tasks' => [
                    'ids' => $this->taskIds,
                    'status' => 'ALL',
                ],
            ]),
        ]);
    }
}
