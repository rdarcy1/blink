<?php

namespace Spatie\Blink;

class Prefixed extends Blink
{
    /**
     * @var Blink
     */
    private $blink;

    /**
     * @var string
     */
    private $prefix;

    /**
     * Prefixed constructor.
     *
     * @param Blink  $blink
     * @param string $prefix
     */
    public function __construct(Blink $blink, $prefix)
    {
        $this->blink = $blink;
        $this->prefix = $prefix;
    }

    /**
     * @inheritDoc
     */
    public function put($key, $value = null)
    {
        return $this->blink->put($this->prefixedKey($key), $value);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key, $default = null)
    {
        return $this->blink->get($this->prefixedKey($key), $default);
    }


    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return $this->blink->has($this->prefixedKey($key));
    }

    /**
     * @inheritDoc
     */
    public function forget(string $key)
    {
        return $this->blink->forget($this->prefixedKey($key));
    }


    /**
     * Construct the prefixed key.
     *
     * @param string $key
     * @return string
     */
    protected function prefixedKey(string $key): string
    {
        return $this->prefix . '.' . $key;
    }
}
