<?php

namespace Spatie\Blink\Test;

use PHPUnit\Framework\TestCase;
use Spatie\Blink\Blink;
use Spatie\Blink\Prefixed;

class PrefixedTest extends TestCase
{
    /**
     * @var Blink
     */
    protected $blink;

    /**
     * @var Prefixed
     */
    protected $prefixed;

    public function setUp()
    {
        parent::setUp();

        $this->blink = new Blink();
        $this->prefixed = $this->blink->prefix('my_prefix');
    }

    /** @test */
    public function it_can_store_a_prefixed_key_value_pair()
    {
        $this->prefixed->put('key', 'value');

        $this->assertSame('value', $this->blink->get('my_prefix.key'));
    }

    /** @test */
    public function it_can_get_a_prefixed_key_value_pair()
    {
        $this->blink->put('my_prefix.key', 'value');

        $this->assertSame('value', $this->prefixed->get('key'));
    }

    /** @test */
    public function it_can_determine_if_the_blink_cache_holds_a_value_for_a_given_name()
    {
        $this->assertFalse($this->prefixed->has('key'));

        $this->blink->put('my_prefix.key', 'value');

        $this->assertTrue($this->prefixed->has('key'));
    }

    /** @test */
    public function it_can_forget_a_value()
    {
        $this->blink->put('my_prefix.key', 'value');
        $this->blink->put('my_prefix.otherKey', 'otherValue');
        $this->blink->put('my_prefix.otherKey2', 'otherValue2');

        $this->prefixed->forget('otherKey');

        $this->assertSame('value', $this->prefixed->get('key'));
        $this->assertNull($this->prefixed->get('otherKey'));
        $this->assertSame('otherValue2', $this->prefixed->get('otherKey2'));
    }
//
    /** @test */
    public function it_can_get_and_forget_a_value()
    {
        $this->blink->put('my_prefix.key', 'value');

        $this->assertSame('value', $this->prefixed->pull('key'));

        $this->assertNull($this->blink->get('my_prefix.key'));
    }
//
//    /** @test */
//    public function it_can_increment_a_new_value()
//    {
//        $returnValue = $this->blink->increment('number');
//
//        $this->assertSame(1, $returnValue);
//
//        $this->assertSame(1, $this->blink->get('number'));
//    }
//
//    /** @test */
//    public function it_can_decrement_a_new_value()
//    {
//        $returnValue = $this->blink->decrement('number');
//
//        $this->assertSame(-1, $returnValue);
//
//        $this->assertSame(-1, $this->blink->get('number'));
//    }
//
//    /** @test */
//    public function it_can_perform_a_function_only_once()
//    {
//        $callable = function () {
//            return rand();
//        };
//
//        $firstResult = $this->blink->once('random', $callable);
//
//        $this->assertNotNull($firstResult);
//
//        foreach (range(1, 10) as $index) {
//            $this->assertSame($firstResult, $this->blink->once('random', $callable));
//        }
//    }
}
