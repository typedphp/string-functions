<?php

namespace TypedPHP\Functions\StringFunctions\Test;

use TypedPHP\Functions\StringFunctions;

class StringFunctionTest extends Test
{
    public function testEndsWith()
    {
        $this->assertTrue(StringFunctions\endsWith("abcdef", "def"));
        $this->assertFalse(StringFunctions\endsWith("abcdef", "abc"));
        $this->assertTrue(StringFunctions\endsWith("abcdef", "#def#"));
        $this->assertFalse(StringFunctions\endsWith("abcdef", "#abc#"));
    }

    public function testMatches()
    {
        $this->assertTrue(StringFunctions\matches("abc", "abc"));
        $this->assertFalse(StringFunctions\matches("abc", "bar"));
        $this->assertTrue(StringFunctions\matches("abc", "#abc#"));
        $this->assertFalse(StringFunctions\matches("abc", "#bar#"));
    }

    public function testIndexOf()
    {
        $this->assertEquals(-1, StringFunctions\indexOf("this is a long string", "bar"));
        $this->assertEquals(-1, StringFunctions\indexOf("this is a long string", "#bar#"));
        $this->assertEquals(5, StringFunctions\indexOf("this is a long string", "is a long"));
        $this->assertEquals(-1, StringFunctions\indexOf("this is a long string", "is a long", 6));
        $this->assertEquals(5, StringFunctions\indexOf("this is a long string", "#is a#"));
        $this->assertEquals(-1, StringFunctions\indexOf("this is a long string", "#is a#", 6));
    }

    public function testLength()
    {
        $this->assertEquals(3, StringFunctions\length("abc"));
    }

    public function testReplace()
    {
        $this->assertEquals("abzzef", StringFunctions\replace("abcdef", "cd", "zz"));
        $this->assertEquals("abcdef", StringFunctions\replace("abcdef", "zz", ""));
        $this->assertEquals("abcdzzcdef", StringFunctions\replace("abcdef", "#(cd)#", "$1zz$1"));
        $this->assertEquals("abcdef", StringFunctions\replace("abcdef", "#zz#", ""));
        $this->assertEquals("acdf", StringFunctions\replace("abcdef", ["b", "e"], ["", ""]));
        $this->assertEquals("acdf", StringFunctions\replace("abcdef", ["#b#", "#e#"], ["", ""]));
    }

    public function testSlice()
    {
        $this->assertEquals("abcdef", StringFunctions\slice("abcdef"));
        $this->assertEquals("bcdef", StringFunctions\slice("abcdef", 1));
        $this->assertEquals("bcde", StringFunctions\slice("abcdef", 1, 4));
        $this->assertEquals("f", StringFunctions\slice("abcdef", -1));
    }

    public function testSplit()
    {
        $this->assertEquals(["a", "b", "c"], StringFunctions\split("abc"));
        $this->assertEquals(["ab", "c"], StringFunctions\split("abc", null, 2));
        $this->assertEquals(["a", "b", "c"], StringFunctions\split("a.b.c", "."));
        $this->assertEquals(["a", "b.c"], StringFunctions\split("a.b.c", ".", 2));
        $this->assertEquals(["a", "b", "c"], StringFunctions\split("a.b.c", "#\\.#"));
        $this->assertEquals(["a", "b.c"], StringFunctions\split("a.b.c", "#\\.#", 2));
    }

    public function testStartsWith()
    {
        $this->assertTrue(StringFunctions\startsWith("abcdef", "abc"));
        $this->assertFalse(StringFunctions\startsWith("abcdef", "def"));
        $this->assertTrue(StringFunctions\startsWith("abcdef", "~abc~"));
        $this->assertFalse(StringFunctions\startsWith("abcdef", "~def~"));
    }
}
