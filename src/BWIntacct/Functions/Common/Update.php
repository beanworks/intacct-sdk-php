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

use BWIntacct\FieldTypes\Record;
use BWIntacct\Functions\AbstractFunction;
use BWIntacct\Xml\Request\Operation\Content\StandardObjects;
use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

class Update extends AbstractFunction
{
    
    /** @var int */
    const MAX_UPDATE_COUNT = 100;

    /** @var Record[] */
    protected $records;

    /**
     * @return Record[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * @param Record[] $records
     */
    public function setRecords(array $records)
    {
        if (count($records) > static::MAX_UPDATE_COUNT) {
            throw new InvalidArgumentException(
                'Records count cannot exceed ' . static::MAX_UPDATE_COUNT
            );
        } elseif (count($records) < 1) {
            throw new InvalidArgumentException(
                'Records count must be greater than zero'
            );
        }

        foreach ($records as $record) {
            $objectName = $record->getObjectName();
            if (in_array('update', StandardObjects::getMethodsNotAllowed($objectName))) {
                throw new InvalidArgumentException(
                    'Using update on object "' . $objectName . '" is not allowed'
                );
            }
        }

        $this->records = $records;
    }

    /**
     * Write the update block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('update');

        foreach ($this->getRecords() as $record) {
            $record->writeXml($xml);
        }

        $xml->endElement(); //update

        $xml->endElement(); //function
    }
}
