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

use BWIntacct\FieldTypes\DateType;
use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Functions\AccountsReceivable\ArPaymentApply
 */
class ArPaymentApplyTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <apply_arpayment>
        <arpaymentkey>1234</arpaymentkey>
        <paymentdate>
            <year>2016</year>
            <month>06</month>
            <day>30</day>
        </paymentdate>
    </apply_arpayment>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $payment = new ArPaymentApply('unittest');
        $payment->setRecordNo(1234);
        $payment->setReceivedDate(new DateType('2016-06-30'));

        $payment->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Record No is required for apply
     */
    public function testRequiredRecordNo()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $payment = new ArPaymentApply('unittest');
        //$payment->setRecordNo(1234);
        $payment->setReceivedDate(new DateType('2016-06-30'));

        $payment->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Received Date is required for apply
     */
    public function testRequiredCustomerId()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $payment = new ArPaymentApply('unittest');
        $payment->setRecordNo(1234);
        //$payment->setReceivedDate(new DateType('2016-06-30'));

        $payment->writeXml($xml);
    }
}
