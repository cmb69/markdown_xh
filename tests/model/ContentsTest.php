<?php

namespace Markdown\Model;

use PHPUnit\Framework\TestCase;

class ContentsTest extends TestCase
{
    public function testIsCountable(): void
    {
        $contents = new Contents(["one", "two", "three"], false);
        $this->assertCount(3, $contents);
    }

    public function testIsIterable(): void
    {
        $contents = new Contents(["one", "two", "three"], true);
        $res = "";
        foreach ($contents as $i => $page) {
            $res .= $i . $page;
        }
        $this->assertSame("0one1two2three", $res);
    }

    public function testDoesNotConvertToHtmlWhenEditing(): void
    {
        $contents = new Contents(["one", "two", "three"], true);
        $page = $contents[1];
        $this->assertSame("two", $page);
    }

    public function testConvertsToHtmlWhenNotEditing(): void
    {
        $contents = new Contents(["one", "two", "three"], false);
        $page = $contents[1];
        $this->assertSame("<p>two</p>", $page);
    }

    public function testOffsetExists(): void
    {
        $contents = new Contents(["one", "two", "three"], true);
        $this->assertFalse(isset($contents["foo"]));
        $this->assertTrue(isset($contents[1]));
    }

    public function testUnsupportedOffsetIsNull(): void
    {
        $contents = new Contents(["one", "two", "three"], false);
        $this->assertNull($contents["foo"]);
        $this->assertNull($contents[3]);
    }

    public function testAppendsWhenOffsetIsNull(): void
    {
        $contents = new Contents(["one", "two", "three"], false);
        $contents[] = "four";
        $this->assertCount(4, $contents);
    }

    public function testModifiesValue(): void
    {
        $contents = new Contents(["one", "two", "three"], true);
        $contents[1] = "four";
        $this->assertSame("four", $contents[1]);
    }
}
