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

namespace BWIntacct\Functions\AccountsReceivable;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Functions\AccountsReceivable\ArAccountLabelCreate
 */
class ArAccountLabelCreateTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <ARACCOUNTLABEL>
            <ACCOUNTLABEL>revenue</ACCOUNTLABEL>
            <DESCRIPTION>hello world</DESCRIPTION>
            <GLACCOUNTNO>4000</GLACCOUNTNO>
        </ARACCOUNTLABEL>
    </create>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ArAccountLabelCreate('unittest');
        $label->setAccountLabel('revenue');
        $label->setDescription('hello world');
        $label->setGlAccountNo('4000');

        $label->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Account Label is required for create
     */
    public function testRequiredAccountLabel()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ArAccountLabelCreate('unittest');
        //$label->setAccountLabel('revenue');
        $label->setDescription('hello world');
        $label->setGlAccountNo('4000');

        $label->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Description is required for create
     */
    public function testRequiredDescription()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ArAccountLabelCreate('unittest');
        $label->setAccountLabel('revenue');
        //$label->setDescription('hello world');
        $label->setGlAccountNo('4000');

        $label->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage GL Account is required for create
     */
    public function testRequiredGlAccount()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ArAccountLabelCreate('unittest');
        $label->setAccountLabel('revenue');
        $label->setDescription('hello world');
        //$label->setGlAccountNo('4000');

        $label->writeXml($xml);
    }
}
