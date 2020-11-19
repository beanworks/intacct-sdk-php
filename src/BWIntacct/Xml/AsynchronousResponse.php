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

namespace BWIntacct\Xml;

use BWIntacct\Exception\IntacctException;
use BWIntacct\Xml\Response\Acknowledgement;
use SimpleXMLIterator;

class AsynchronousResponse extends AbstractResponse
{

    /** @var Acknowledgement */
    private $acknowledgement;

    /**
     * Initializes the class with the given body XML response
     *
     * @param string $body
     * @throws IntacctException
     */
    public function __construct($body)
    {
        parent::__construct($body);
        if (!isset($this->xml->acknowledgement)) {
            throw new IntacctException('Response is missing acknowledgement block');
        }
        $this->setAcknowledgement($this->xml->acknowledgement);
    }

    /**
     * Set response acknowledgement
     *
     * @param SimpleXMLIterator $acknowledgement
     * @throws IntacctException
     */
    private function setAcknowledgement(SimpleXMLIterator $acknowledgement)
    {
        $this->acknowledgement = new Acknowledgement($acknowledgement);
    }

    /**
     * Get response acknowledgement
     *
     * @return Acknowledgement
     */
    public function getAcknowledgement()
    {
        return $this->acknowledgement;
    }
}
