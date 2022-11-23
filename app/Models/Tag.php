<?php


namespace App\Models;


class Tag
{
    protected string $name;
    protected int $count = 0;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function add(): void
    {
        $this->count += 1;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
