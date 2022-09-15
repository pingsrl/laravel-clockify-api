<?php

namespace Ping\LaravelClockifyApi\API;

class ClockifyTasks extends ClockifyAPI
{
    private string $projectId = '';
    private bool $isActive = true;

    protected function requestData()
    {
        return $this->filter((array) [
            'page' => $this->page,
            'pageSize' => $this->pageSize,
            'sortColumn' => 'NAME',
            $this->mergeWhen(null !== $this->isActive, [
                'isActive' => $this->isActive,
            ]),
        ]);
    }

    protected function getEndpoint()
    {
        return '/workspaces/'.$this->workspaceId.'/projects/'.$this->projectId.'/tasks';
    }

    public function forProjectId(string $projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function isActive(bool $isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
}
