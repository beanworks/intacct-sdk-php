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
 * @coversDefaultClass \BWIntacct\Functions\Common\ReadRelated
 */
class ReadRelatedTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <readRelated>
        <object>CUSTOM_OBJECT</object>
        <relation>CUSTOM_OBJECT_ITEM</relation>
        <keys/>
        <fields>*</fields>
    </readRelated>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readRelated = new ReadRelated('unittest');
        $readRelated->setObjectName('CUSTOM_OBJECT');
        $readRelated->setRelationName('CUSTOM_OBJECT_ITEM');

        $readRelated->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testParamOverrides()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<function controlid="unittest">
    <readRelated>
        <object>CUSTOM_OBJECT</object>
        <relation>CUSTOM_OBJECT_ITEM</relation>
        <keys>KEY1,KEY2</keys>
        <fields>FIELD1,FIELD2</fields>
        <returnFormat>xml</returnFormat>
    </readRelated>
</function>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $readRelated = new ReadRelated('unittest');
        $readRelated->setObjectName('CUSTOM_OBJECT');
        $readRelated->setRelationName('CUSTOM_OBJECT_ITEM');
        $readRelated->setKeys(['KEY1','KEY2']);
        $readRelated->setFields(['FIELD1','FIELD2']);
        $readRelated->setReturnFormat('xml');

        $readRelated->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Relation Name is required for read related
     */
    public function testNoRelation()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $read = new ReadRelated('unittest');
        $read->setObjectName('CUSTOM_OBJECT');

        $read->writeXml($xml);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Return Format is not a valid format
     */
    public function testInvalidReturnFormat()
    {
        $read = new ReadRelated('unittest');
        $read->setReturnFormat('bad');
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Keys count cannot exceed 100
     */
    public function testMaxNumberOfKeys()
    {
        $keys = new \SplFixedArray(101);

        $read = new ReadRelated('unittest');
        $read->setKeys($keys->toArray());
    }
}
