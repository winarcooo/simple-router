<?php

namespace Winarcooo\SimpleRouter;

interface RouterInterface
{
    public function add(string $method, string $uri, callable|array $target): void;

    public function matcher(): void;

    public function list(): array;
}