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

namespace BWIntacct\Exception;

use BWIntacct\Xml\SynchronousResponse;

/**
 * @coversDefaultClass \BWIntacct\Exception\ResultException
 */
class ResultExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ResultException
     */
    protected $object;

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

    public function testGetErrors()
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
      <operation>
            <authentication>
                  <status>success</status>
                  <userid>fakeuser</userid>
                  <companyid>fakecompany</companyid>
                  <sessiontimestamp>2015-10-25T10:08:34-07:00</sessiontimestamp>
            </authentication>
            <result>
                  <status>failure</status>
                  <function>read</function>
                  <controlid>testFunctionId</controlid>
                  <errormessage>
                        <error>
                              <errorno>XXX</errorno>
                              <description></description>
                              <description2>Object definition VENDOR2 not found</description2>
                              <correction></correction>
                        </error>
                  </errormessage>
            </result>
      </operation>
</response>
EOF;

        try {
            new SynchronousResponse($xml);
        } catch (ResultException $ex) {
            $this->assertInternalType('array', $ex->getErrors());
        }
    }
}
