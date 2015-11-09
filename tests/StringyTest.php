<?php

namespace Mpclarkson\Stringy;

class StringyTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Mpclarkson\Stringy\Stringy
     */
    private $stringy;

    public function setUp()
    {
        $string = "foo string";
        $this->stringy = new Stringy($string);
    }

    /**
     * @covers Stringy::__construct
     * @uses Stringy
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('Mpclarkson\Stringy\Stringy', $this->stringy);
    }

    /**
     * @covers Stringy::__construct
     * @covers StringyException::__construct
     * @uses Stringy
     */
    public function testConstructException()
    {
        $this->setExpectedException('Mpclarkson\Stringy\StringyException');
        new Stringy(1);
    }

    /**
     * @covers Stringy::string
     * @uses Stringy
     */
    public function testString()
    {
       $this->assertEquals("foo string", $this->stringy->string());
    }

    /**
     * @covers Stringy::truncate
     * @uses Stringy
     */
    public function testTruncate()
    {
        $this->stringy->truncate(3);

        $this->assertEquals("foo...", $this->stringy->string());
    }
    /**
     * @covers Stringy::truncate
     * @uses Stringy
     */
    public function testTruncateLongerThanChar()
    {
        $this->stringy->truncate(30000);

        $this->assertEquals("foo string", $this->stringy->string());
    }

    /**
     * @covers Stringy::length
     * @uses Stringy
     */
    public function testLength()
    {
        $this->assertEquals(10, $this->stringy->length());
    }

    /**
     * @covers Stringy::contains
     * @uses Stringy
     */
    public function testContainsTrue()
    {
        $this->assertTrue($this->stringy->contains("foo"));
    }

    /**
     * @covers Stringy::contains
     * @uses Stringy
     */
    public function testContainsFalse()
    {
        $this->assertFalse($this->stringy->contains("zzzzz"));
    }

    /**
     * @covers Stringy::startsWith
     * @uses Stringy
     */
    public function testStartsWithTrue()
    {
        $this->assertTrue($this->stringy->startsWith("foo"));
    }

    /**
     * @covers Stringy::startsWith
     * @uses Stringy
     */
    public function testStartsWithFalse()
    {
        $this->assertFalse($this->stringy->startsWith("zzz"));
    }

    /**
     * @covers Stringy::endsWith
     * @uses Stringy
     */
    public function testEndsWithTrue()
    {
        $this->assertTrue($this->stringy->endsWith("string"));
    }

    /**
     * @covers Stringy::endsWith
     * @uses Stringy
     */
    public function testEndsWithFalse()
    {
        $this->assertFalse($this->stringy->endsWith("zzz"));
    }

    /**
     * @covers Stringy::append
     * @uses Stringy
     */
    public function testAppend()
    {
        $this->assertEquals("foo string zzz", $this->stringy->append("zzz")->string());
    }

    /**
     * @covers Stringy::reverse
     * @uses Stringy
     */
    public function testReverse()
    {
        $this->assertEquals("gnirts oof", $this->stringy->reverse()->string());
    }

    /**
     * @covers Stringy::uppercase
     * @uses Stringy
     */
    public function testUppercase()
    {
        $this->assertContains("FOO STRING", $this->stringy->uppercase()->string());
    }

    /**
     * @covers Stringy::uppercaseFirst
     * @uses Stringy
     */
    public function testUppercaseFirst()
    {
        $this->assertContains("Foo string", $this->stringy->uppercaseFirst()->string());
    }

    /**
     * @covers Stringy::lowercase
     * @uses Stringy
     */
    public function testLowercase()
    {
        $upper = new Stringy("FOO STRING");
        $this->assertContains("foo string", $upper->lowercase()->string());
    }

    /**
     * @covers Stringy::lowercaseFirst
     * @uses Stringy
     */
    public function testLowercaseFirst()
    {
        $upper = new Stringy("FOO STRING");
        $this->assertContains("fOO STRING", $upper->lowercaseFirst()->string());
    }

    /**
     * @covers Stringy::titleCase
     * @uses Stringy
     */
    public function testTitleCase()
    {
        $this->assertContains("Foo String", $this->stringy->titleCase()->string());
    }

    /**
     * @covers Stringy::sentenceCase
     * @uses Stringy
     */
    public function testSentenceCase()
    {
        $upper = new Stringy("first sentence. second sentence.");
        $this->assertContains("First sentence. Second sentence.", $upper->sentenceCase()->string());
    }

    /**
     * @covers Stringy::toArray
     * @uses Stringy
     */
    public function testToArrayNoDelimiter()
    {
        $this->assertCount(10, $this->stringy->toArray());
    }

    /**
     * @covers Stringy::toArray
     * @uses Stringy
     */
    public function testToArrayWithDelimiter()
    {
        $this->assertCount(2, $this->stringy->toArray(" "));
    }

    /**
     * @covers Stringy::apply
     * @uses Stringy
     */
    public function testApply()
    {
        $this->stringy->apply(function($entry) {
            return $entry . "-" ;
        });

        $this->assertEquals("f-o-o- -s-t-r-i-n-g-", $this->stringy->string());
    }
}
