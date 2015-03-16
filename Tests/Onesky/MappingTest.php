<?php

namespace Seven\Bundle\OneskyBundle\Tests\Onesky;

use Seven\Bundle\OneskyBundle\Onesky\Mapping;

class MappingTest extends \PHPUnit_Framework_TestCase
{
    public function testUseLocale()
    {
        $mapping = new Mapping(array(), array('es', 'ca'), '[filename].txt');

        $this->assertTrue($mapping->useLocale('es'));
        $this->assertFalse($mapping->useLocale('en'));
    }

    public function testUseLocaleWhenLocalesAreNotSet()
    {
        $mapping = new Mapping(array(), array(), '[filename].txt');

        $this->assertTrue($mapping->useLocale('es'));
        $this->assertTrue($mapping->useLocale('en'));
    }

    public function testUseSource()
    {
        $mapping = new Mapping(array('messages.xliff', 'messages.yml'), array(), '[filename].txt');

        $this->assertTrue($mapping->useSource('messages.xliff'));
        $this->assertFalse($mapping->useSource('messages.po'));
    }

    public function testUseSourceWhenSourcesAreNotSet()
    {
        $mapping = new Mapping(array(), array(), '[filename].txt');

        $this->assertTrue($mapping->useLocale('messages.xliff'));
        $this->assertTrue($mapping->useLocale('messages.po'));
    }

    public function testFormatOutputFilename()
    {
        $mapping = new Mapping(array(), array(), '[dirname]::[filename]::[extension]::[ext]::[locale]');

        $this->assertEquals(
            'dirname::filename::extension::extension::locale',
            $mapping->getOutputFilename('dirname/filename.extension', 'locale')
        );
    }
}
