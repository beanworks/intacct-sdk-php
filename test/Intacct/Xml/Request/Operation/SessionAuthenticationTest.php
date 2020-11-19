<?php

namespace BWIntacct\Xml\Request\Operation;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Xml\Request\Operation\SessionAuthentication
 */
class SessionAuthenticationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testWriteXml()
    {
        $config = [
            'session_id' => 'testsessionid..',
        ];
        
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<authentication>
    <sessionid>testsessionid..</sessionid>
</authentication>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $sessionAuth = new SessionAuthentication($config);
        $sessionAuth->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
    
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Required "session_id" key not supplied in params
     */
    public function testInvalidSession()
    {
        $config = [
            'session_id' => null,
        ];
        
        new SessionAuthentication($config);
    }
}
