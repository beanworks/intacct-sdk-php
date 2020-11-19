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

namespace BWIntacct\Xml\Request\Operation;

use InvalidArgumentException;
use BWIntacct\Xml\XMLWriter;

class LoginAuthentication extends AbstractAuthentication
{

    /** @var string */
    private $userId;

    /** @var string */
    private $companyId;

    /** @var string */
    private $password;

    /**
     * Initializes the class with the given parameters.
     *
     * @param array $params {
     *      @var string $company_id Intacct company ID
     *      @var string $user_id Intacct user ID
     *      @var string $user_password Intacct user password
     * }
     * @todo Add clientid and location since people don't know to pipe them with companyid
     */
    public function __construct(array $params)
    {
        $defaults = [
            'company_id' => null,
            'user_id' => null,
            'user_password' => null,
        ];
        $config = array_merge($defaults, $params);
        
        if (!$config['user_id']) {
            throw new InvalidArgumentException(
                'Required "user_id" key not supplied in params'
            );
        }
        if (!$config['company_id']) {
            throw new InvalidArgumentException(
                'Required "company_id" key not supplied in params'
            );
        }
        if (!$config['user_password']) {
            throw new InvalidArgumentException(
                'Required "user_password" key not supplied in params'
            );
        }

        $this->userId = $config['user_id'];
        $this->companyId = $config['company_id'];
        $this->password = $config['user_password'];
    }

    /**
     * Write the operation block XML
     *
     * @param XMLWriter $xml
     */
    public function writeXml(&$xml)
    {
        $xml->startElement('authentication');
        $xml->startElement('login');
        $xml->writeElement('userid', $this->userId, true);
        $xml->writeElement('companyid', $this->companyId, true);
        $xml->writeElement('password', $this->password, true);
        $xml->endElement(); //login
        $xml->endElement(); //authentication
    }
}
