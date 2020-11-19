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

use BWIntacct\Functions\Traits\CustomFieldsTrait;
use BWIntacct\Xml\XMLWriter;

abstract class AbstractBillLine
{

    use CustomFieldsTrait;

    /** @var string */
    protected $accountLabel;

    /** @var string */
    protected $glAccountNumber;

    /** @var string */
    protected $offsetGLAccountNumber;

    /** @var string|float */
    protected $transactionAmount;

    /** @var string */
    protected $allocationId;

    /** @var string */
    protected $memo;

    /** @var bool */
    protected $form1099;

    /** @var string */
    protected $key;

    /** @var string|float */
    protected $totalPaid;

    /** @var string|float */
    protected $totalDue;

    /** @var bool */
    protected $billable;

    /** @var string */
    protected $departmentId;

    /** @var string */
    protected $locationId;

    /** @var string */
    protected $projectId;

    /** @var string */
    protected $customerId;

    /** @var string */
    protected $vendorId;

    /** @var string */
    protected $employeeId;

    /** @var string */
    protected $itemId;

    /** @var string */
    protected $classId;

    /** @var string */
    protected $contractId;

    /** @var string */
    protected $warehouseId;

    /**
     * Get account label
     *
     * @return string
     */
    public function getAccountLabel()
    {
        return $this->accountLabel;
    }

    /**
     * Set account label
     *
     * @param string $accountLabel
     */
    public function setAccountLabel($accountLabel)
    {
        $this->accountLabel = $accountLabel;
    }

    /**
     * Get GL account number
     *
     * @return string
     */
    public function getGlAccountNumber()
    {
        return $this->glAccountNumber;
    }

    /**
     * Set GL account number
     *
     * @param string $glAccountNumber
     */
    public function setGlAccountNumber($glAccountNumber)
    {
        $this->glAccountNumber = $glAccountNumber;
    }

    /**
     * Get offset GL account number
     *
     * @return string
     */
    public function getOffsetGLAccountNumber()
    {
        return $this->offsetGLAccountNumber;
    }

    /**
     * Set offset GL account number
     *
     * @param string $offsetGLAccountNumber
     */
    public function setOffsetGLAccountNumber($offsetGLAccountNumber)
    {
        $this->offsetGLAccountNumber = $offsetGLAccountNumber;
    }

    /**
     * Get transaction amount
     *
     * @return float|string
     */
    public function getTransactionAmount()
    {
        return $this->transactionAmount;
    }

    /**
     * Set transaction amount
     *
     * @param float|string $transactionAmount
     */
    public function setTransactionAmount($transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;
    }

    /**
     * Get allocation ID
     *
     * @return string
     */
    public function getAllocationId()
    {
        return $this->allocationId;
    }

    /**
     * Set allocation ID
     *
     * @param string $allocationId
     */
    public function setAllocationId($allocationId)
    {
        $this->allocationId = $allocationId;
    }

    /**
     * Get memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set memo
     *
     * @param string $memo
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    }

    /**
     * Get form 1099
     *
     * @return boolean
     */
    public function isForm1099()
    {
        return $this->form1099;
    }

    /**
     * Set form 1099
     *
     * @param boolean $form1099
     */
    public function setForm1099($form1099)
    {
        $this->form1099 = $form1099;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set key
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Get total paid
     *
     * @return float|string
     */
    public function getTotalPaid()
    {
        return $this->totalPaid;
    }

    /**
     * Set total paid
     *
     * @param float|string $totalPaid
     */
    public function setTotalPaid($totalPaid)
    {
        $this->totalPaid = $totalPaid;
    }

    /**
     * Get total due
     *
     * @return float|string
     */
    public function getTotalDue()
    {
        return $this->totalDue;
    }

    /**
     * Set total due
     *
     * @param float|string $totalDue
     */
    public function setTotalDue($totalDue)
    {
        $this->totalDue = $totalDue;
    }

    /**
     * Get billable
     *
     * @return boolean
     */
    public function isBillable()
    {
        return $this->billable;
    }

    /**
     * Set billable
     *
     * @param boolean $billable
     */
    public function setBillable($billable)
    {
        $this->billable = $billable;
    }

    /**
     * Get department ID
     *
     * @return string
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * Set department ID
     *
     * @param string $departmentId
     */
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }

    /**
     * Get location ID
     *
     * @return string
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Set location ID
     *
     * @param string $locationId
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    /**
     * Get project ID
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set project ID
     *
     * @param string $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * Get customer ID
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set customer ID
     *
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Get vendor ID
     *
     * @return string
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * Set vendor ID
     *
     * @param string $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * Get employee ID
     *
     * @return string
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * Set employee ID
     *
     * @param string $employeeId
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * Get item ID
     *
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set item ID
     *
     * @param string $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * Get class ID
     *
     * @return string
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set class ID
     *
     * @param string $classId
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
    }

    /**
     * Get contract ID
     *
     * @return string
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * Set contract ID
     *
     * @param string $contractId
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * Get warehouse ID
     *
     * @return string
     */
    public function getWarehouseId()
    {
        return $this->warehouseId;
    }

    /**
     * Set warehouse ID
     *
     * @param string $warehouseId
     */
    public function setWarehouseId($warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    abstract public function writeXml(XMLWriter &$xml);
}
