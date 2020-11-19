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

namespace BWIntacct\Functions;

use BWIntacct\Xml\XMLWriter;

interface FunctionInterface
{

    public function __construct();
    
    public function getControlId();
    
    public function setControlId($controlId);

    /**
     * Write the XML
     *
     * @param XMLWriter $xml
     */
    public function writeXml(XMLWriter &$xml);
}
