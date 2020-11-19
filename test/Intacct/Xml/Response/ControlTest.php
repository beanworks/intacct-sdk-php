<?php
/**
 * Copyright 2017 Sage Intacct, Inc.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License"). You may not
 *  use this file except in compliance with the License. You may obtain a copy
 *  of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 *
 */

namespace BWIntacct\Xml\Response;

use Exception;

/**
 * @coversDefaultClass \BWIntacct\Xml\Response\Control
 */
class ControlTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Control
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control>
            <status>success</status>
            <senderid>testsenderid</senderid>
            <controlid>ControlIdHere</controlid>
            <uniqueid>false</uniqueid>
            <dtdversion>3.0</dtdversion>
      </control>
</response>
EOF;

        $args = [
            $xml,
        ];
        $stub = $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);

        $this->object = $stub->getControl();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testGetStatus()
    {
        $this->assertEquals('success', $this->object->getStatus());
    }

    public function testGetSenderId()
    {
        $this->assertEquals('testsenderid', $this->object->getSenderId());
    }

    public function testGetControlId()
    {
        $this->assertEquals('ControlIdHere', $this->object->getControlId());
    }

    public function testGetUniqueId()
    {
        $this->assertEquals('false', $this->object->getUniqueId());
    }

    public function testGetDtdVersion()
    {
        $this->assertEquals('3.0', $this->object->getDtdVersion());
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Control block is missing status element
     */
    public function testMissingStatusElement()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control/>
</response>
EOF;

        $args = [
            $xml,
        ];
        $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Control block is missing senderid element
     */
    public function testMissingSenderIdElement()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control>
            <status>success</status>
            <!--<senderid>testsenderid</senderid>-->
            <controlid>ControlIdHere</controlid>
            <uniqueid>false</uniqueid>
            <dtdversion>3.0</dtdversion>
      </control>
</response>
EOF;

        $args = [
            $xml,
        ];
        $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Control block is missing controlid element
     */
    public function testMissingControlIdElement()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control>
            <status>success</status>
            <senderid>testsenderid</senderid>
            <!--<controlid>ControlIdHere</controlid>-->
            <uniqueid>false</uniqueid>
            <dtdversion>3.0</dtdversion>
      </control>
</response>
EOF;

        $args = [
            $xml,
        ];
        $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Control block is missing uniqueid element
     */
    public function testMissingUniqueIdElement()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control>
            <status>success</status>
            <senderid>testsenderid</senderid>
            <controlid>ControlIdHere</controlid>
            <!--<uniqueid>false</uniqueid>-->
            <dtdversion>3.0</dtdversion>
      </control>
</response>
EOF;

        $args = [
            $xml,
        ];
        $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);
    }
    
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Control block is missing dtdversion element
     */
    public function testMissingDtdVersionElement()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<response>
      <control>
            <status>success</status>
            <senderid>testsenderid</senderid>
            <controlid>ControlIdHere</controlid>
            <uniqueid>false</uniqueid>
            <!--<dtdversion>3.0</dtdversion>-->
      </control>
</response>
EOF;

        $args = [
            $xml,
        ];
        $this->getMockForAbstractClass('Intacct\Xml\AbstractResponse', $args);
    }
}
