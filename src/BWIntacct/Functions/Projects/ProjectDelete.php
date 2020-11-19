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

namespace BWIntacct\Functions\Projects;

use BWIntacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Delete an existing project record
 */
class ProjectDelete extends AbstractProject
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

        $xml->startElement('delete_project');

        if (!$this->getProjectId()) {
            throw new InvalidArgumentException('Project ID is required for delete');
        }
        $xml->writeAttribute('key', $this->getProjectId());

        $xml->endElement(); //delete_project

        $xml->endElement(); //function
    }
}
