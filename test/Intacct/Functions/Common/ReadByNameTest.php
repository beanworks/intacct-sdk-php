<?php
/**
 * Copyright 2017 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace BWIntacct\Functions\Common;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Functions\Common\ReadByName
 */
class ReadByNameTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <readByName>
        <object>GLENTRY</object>
        <keys></keys>
        <fields>*</fields>
    </readByName>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readByName = new ReadByName('unittest');
        $readByName->setObjectName('GLENTRY');

        $readByName->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testParamOverrides()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <readByName>
        <object>GLENTRY</object>
        <keys>987</keys>
        <fields>TRX_AMOUNT,RECORDNO,BATCHNO</fields>
        <returnFormat>xml</returnFormat>
        <docparid>Sales Invoice</docparid>
    </readByName>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readByName = new ReadByName('unittest');
        $readByName->setObjectName('GLENTRY');
        $readByName->setNames(['987']);
        $readByName->setFields(['TRX_AMOUNT','RECORDNO','BATCHNO']);
        $readByName->setDocParId('Sales Invoice');
        $readByName->setReturnFormat('xml');

        $readByName->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Return Format is not a valid format
     */
    public function testInvalidReturnFormat()
    {
        $readByName = new ReadByName('unittest');
        $readByName->setReturnFormat('blah');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Names count cannot exceed 100
     */
    public function testMaxNumberOfNames()
    {
        $names = new \SplFixedArray(101);

        $readByName = new ReadByName('unittest');
        $readByName->setNames($names->toArray());
    }
}
