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

namespace BWIntacct\Functions\OrderEntry;

use BWIntacct\Functions\InventoryControl\TransactionSubtotalCreate;
use BWIntacct\Xml\XMLWriter;
use BWIntacct\FieldTypes\DateType;
use InvalidArgumentException;

/**
 * @coversDefaultClass \BWIntacct\Functions\InventoryControl\OrderEntryTransactionCreate
 */
class OrderEntryTransactionCreateTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create_sotransaction>
        <transactiontype>Sales Order</transactiontype>
        <datecreated>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </datecreated>
        <customerid>2530</customerid>
        <sotransitems>
            <sotransitem>
                <itemid>02354032</itemid>
                <quantity>1200</quantity>
            </sotransitem>
        </sotransitems>
    </create_sotransaction>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $transaction = new OrderEntryTransactionCreate('unittest');
        $transaction->setTransactionDefinition('Sales Order');
        $transaction->setTransactionDate(new DateType('2015-06-30'));
        $transaction->setCustomerId('2530');

        $line1 = new OrderEntryTransactionLineCreate();
        $line1->setItemId('02354032');
        $line1->setQuantity(1200);
        $transaction->setLines([
            $line1,
        ]);

        $transaction->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testSubtotalEntry()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create_sotransaction>
        <transactiontype>Sales Order</transactiontype>
        <datecreated>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </datecreated>
        <customerid>2530</customerid>
        <sotransitems>
            <sotransitem>
                <itemid>02354032</itemid>
                <quantity>1200</quantity>
            </sotransitem>
        </sotransitems>
        <subtotals>
            <subtotal>
                <description>Subtotal Description</description>
                <total>1200</total>
            </subtotal>
        </subtotals>
    </create_sotransaction>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $transaction = new OrderEntryTransactionCreate('unittest');
        $transaction->setTransactionDefinition('Sales Order');
        $transaction->setTransactionDate(new DateType('2015-06-30'));
        $transaction->setCustomerId('2530');

        $line1 = new OrderEntryTransactionLineCreate();
        $line1->setItemId('02354032');
        $line1->setQuantity(1200);
        $transaction->setLines([
            $line1,
        ]);

        $subtotal1 = new TransactionSubtotalCreate();
        $subtotal1->setDescription('Subtotal Description');
        $subtotal1->setTotal(1200);
        $transaction->setSubtotals([
            $subtotal1,
        ]);

        $transaction->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testParamOverrides()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <create_sotransaction>
        <transactiontype>Sales Order</transactiontype>
        <datecreated>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </datecreated>
        <dateposted>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </dateposted>
        <createdfrom>Sales Quote-Q1002</createdfrom>
        <customerid>23530</customerid>
        <documentno>23430</documentno>
        <origdocdate>
            <year>2015</year>
            <month>06</month>
            <day>15</day>
        </origdocdate>
        <referenceno>234235</referenceno>
        <termname>N30</termname>
        <datedue>
            <year>2020</year>
            <month>09</month>
            <day>24</day>
        </datedue>
        <message>Submit</message>
        <shippingmethod>USPS</shippingmethod>
        <shipto>
            <contactname>28952</contactname>
        </shipto>
        <billto>
            <contactname>289533</contactname>
        </billto>
        <supdocid>6942</supdocid>
        <externalid>20394</externalid>
        <basecurr>USD</basecurr>
        <currency>USD</currency>
        <exchratedate>
            <year>2015</year>
            <month>06</month>
            <day>30</day>
        </exchratedate>
        <exchratetype>Intacct Daily Rate</exchratetype>
        <vsoepricelist>VSOEPricing</vsoepricelist>
        <customfields>
            <customfield>
                <customfieldname>customfield1</customfieldname>
                <customfieldvalue>customvalue1</customfieldvalue>
            </customfield>
        </customfields>
        <state>Pending</state>
        <projectid>P2904</projectid>
        <sotransitems>
            <sotransitem>
                <itemid>2390552</itemid>
                <quantity>223</quantity>
            </sotransitem>
        </sotransitems>
        <subtotals>
            <subtotal>
                <description>Subtotal description</description>
                <total>223</total>
            </subtotal>
        </subtotals>
    </create_sotransaction>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $transaction = new OrderEntryTransactionCreate('unittest');
        $transaction->setTransactionDefinition('Sales Order');
        $transaction->setTransactionDate(new DateType('2015-06-30'));
        $transaction->setGlPostingDate(new DateType('2015-06-30'));
        $transaction->setCreatedFrom('Sales Quote-Q1002');
        $transaction->setCustomerId('23530');
        $transaction->setDocumentNumber('23430');
        $transaction->setOriginalDocumentDate(new DateType('2015-06-15'));
        $transaction->setReferenceNumber('234235');
        $transaction->setPaymentTerm('N30');
        $transaction->setDueDate(new DateType('2020-09-24'));
        $transaction->setMessage('Submit');
        $transaction->setShippingMethod('USPS');
        $transaction->setShipToContactName('28952');
        $transaction->setBillToContactName('289533');
        $transaction->setAttachmentsId('6942');
        $transaction->setExternalId('20394');
        $transaction->setBaseCurrency('USD');
        $transaction->setTransactionCurrency('USD');
        $transaction->setExchangeRateDate(new DateType('2015-06-30'));
        $transaction->setExchangeRateType('Intacct Daily Rate');
        $transaction->setVsoePriceList('VSOEPricing');
        $transaction->setCustomFields([
            'customfield1' => 'customvalue1'
        ]);
        $transaction->setState('Pending');
        $transaction->setProjectId('P2904');

        $line1 = new OrderEntryTransactionLineCreate();
        $line1->setItemId('2390552');
        $line1->setQuantity(223);
        $transaction->setLines([
            $line1,
        ]);

        $subtotal1 = new TransactionSubtotalCreate();
        $subtotal1->setDescription('Subtotal description');
        $subtotal1->setTotal(223);
        $transaction->setSubtotals([
            $subtotal1,
        ]);

        $transaction->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage OE Transaction must have at least 1 line
     */
    public function testMissingOrderEntryTransactionEntries()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $transaction = new OrderEntryTransactionCreate('unittest');
        $transaction->setTransactionDefinition('Sales Order');
        $transaction->setTransactionDate(new DateType('2015-06-30'));
        $transaction->setCustomerId('2530');

        $transaction->writeXml($xml);
    }
}
