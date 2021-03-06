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

namespace BWIntacct\Functions\AccountsPayable;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Approve an existing AP payment request record
 */
class ApPaymentRequestApprove extends AbstractApPaymentRequest
{

    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('approve_appaymentrequest');

        if (!$this->getRecordNo()) {
            throw new InvalidArgumentException('Record No is required for approve');
        }
        $xml->startElement('appaymentkeys');

        $xml->writeElement('appaymentkey', $this->getRecordNo(), true);

        $xml->endElement(); //appaymentkeys

        $xml->endElement(); //approve_appaymentrequest

        $xml->endElement(); //function
    }
}
