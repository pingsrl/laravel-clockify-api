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

        return $this;
    }

    public function getAll(): Collection
    {
        /** @var Collection */
        $result = $this->get();

        do {
            /** @var Collection */
            $page = $this->nextPage()->get();

            $result->push(...$page);
        } while ($page->isNotEmpty() && $page->count() == $this->pageSize);

        return $result;
    }
}
