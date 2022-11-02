<?php

declare(strict_types=1);

use PhpBench\Attributes\Revs;

final class CloneBench
{
    public function __construct()
    {
        $this->template = (new Immutable())
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test');
    }

    #[Revs(100000)]
    public function benchMutable(): void
    {
        $mutable = new Mutable();
        $mutable->setProp('test');
        $mutable->setProp('test');
        $mutable->setProp('test');
        $mutable->setProp('test');
        $mutable->setProp('test');
        $mutable->setProp('test');
        $mutable->setProp('test');
    }

    #[Revs(100000)]
    public function benchImmutable(): void
    {
        (new Immutable())
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test')
            ->withProp('test');
    }

    #[Revs(100000)]
    public function benchRR(): void
    {
        $this->template->withProp('test');
    }
}

final class Immutable {
    private string $prop;

    /**
     * @param string $prop
     */
    public function withProp(string $prop): self
    {
        $new = clone $this;
        $new->prop = $prop;

        return $new;
    }
}

final class Mutable {
    private string $prop;

    /**
     * @param string $prop
     */
    public function setProp(string $prop): void
    {
        $this->prop = $prop;
    }
}
