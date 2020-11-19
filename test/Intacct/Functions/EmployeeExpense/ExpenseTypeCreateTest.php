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

namespace BWIntacct\Functions\EmployeeExpense;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Functions\EmployeeExpense\ExpenseTypeCreate
 */
class ExpenseTypeCreateTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create>
        <EEACCOUNTLABEL>
            <ACCOUNTLABEL>Travel</ACCOUNTLABEL>
            <DESCRIPTION>hello world</DESCRIPTION>
            <GLACCOUNTNO>7000</GLACCOUNTNO>
        </EEACCOUNTLABEL>
    </create>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ExpenseTypeCreate('unittest');
        $label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

        $label->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Expense Type is required for create
     */
    public function testRequiredAccountLabel()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $label = new ExpenseTypeCreate('unittest');
        //$label->setExpenseType('Travel');
        $label->setDescription('hello world');
        $label->setGlAccountNo('7000');

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

        $label = new ExpenseTypeCreate('unittest');
        $label->setExpenseType('Travel');
        //$label->setDescription('hello world');
        $label->setGlAccountNo('7000');

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

        $label = new ExpenseTypeCreate('unittest');
        $label->setExpenseType('Travel');
        $label->setDescription('hello world');
        //$label->setGlAccountNo('7000');

        $label->writeXml($xml);
    }
}
