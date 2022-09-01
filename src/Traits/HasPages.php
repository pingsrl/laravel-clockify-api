<?php

namespace Ping\LaravelClockifyApi\Traits;

use Illuminate\Support\Collection;

trait HasPages
{
    protected int $page = 1;

    protected int $pageSize = 50;

    public function page(int $page)
    {
        $this->page = $page;

        return $this;
    }

    public function pageSize(int $pageSize)
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    public function nextPage()
    {
        $this->page($this->page + 1);

        return $this->requestData();
    }

    public function getAll(): Collection
    {
        /** @var Collection */
        $result = $this->get();

        do {
            $this->nextPage();

            /** @var Collection */
            $page = $this->get();

            $result->concat($page);
        } while (false == $page->empty());

        return $result;
    }
}
