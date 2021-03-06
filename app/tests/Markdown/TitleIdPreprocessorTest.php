<?php

namespace tests\Markdown;

use helpers\Markdown\TitleIdPreprocessor;

class TitleIdPreprocessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function parse_should_add_title_ids()
    {
        $str = <<<MARKDOWN
Adds autogenerated ID attributes to titles.

## title

Paragraph

## Some title {#hello}

## Some title 2

Code block:
    ## Some title
    ## Some title {#test}
MARKDOWN;

        $expected = <<<MARKDOWN
Adds autogenerated ID attributes to titles.

## title {#title}

Paragraph

## Some title {#hello}

## Some title 2 {#some-title-2}

Code block:
    ## Some title
    ## Some title {#test}
MARKDOWN;

        $this->assertParsedStringEquals($expected, $str);
    }
    /**
     * @test
     */
    public function preprocessor_should_call_wrapped_parser()
    {
        $wrapped = $this->getMockForAbstractClass('helpers\Markdown\MarkdownParserInterface');
        $wrapped->expects($this->once())
            ->method('parse')
            ->with('foo')
            ->willReturn('bar');

        $parser = new TitleIdPreprocessor($wrapped);

        $this->assertEquals('bar', $parser->parse('foo'));
    }

    private function assertParsedStringEquals($expected, $markdown)
    {
        $parser = new TitleIdPreprocessor(new FakeMarkdownParser());
        $this->assertEquals($expected, $parser->parse($markdown));
    }
}
