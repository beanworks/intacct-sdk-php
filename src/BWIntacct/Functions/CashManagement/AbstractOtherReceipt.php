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

namespace BWIntacct\Functions\CashManagement;

use BWIntacct\FieldTypes\DateType;
use BWIntacct\Functions\AbstractFunction;
use BWIntacct\Functions\Traits\CustomFieldsTrait;

abstract class AbstractOtherReceipt extends AbstractFunction
{

    use CustomFieldsTrait;

    /** @var DateType */
    protected $receiptDate;

    /** @var string */
    protected $payer;

    /** @var string */
    protected $paymentMethod;

    /** @var DateType */
    protected $transactionDate;

    /** @var string */
    protected $transactionNo;

    /** @var string */
    protected $description;

    /** @var string */
    protected $attachmentsId;

    /** @var string */
    protected $bankAccountId;

    /** @var DateType */
    protected $depositDate;

    /** @var string */
    protected $undepositedFundsGlAccountNo;

    /** @var string */
    protected $transactionCurrency;

    /** @var DateType */
    protected $exchangeRateDate;

    /** @var float */
    protected $exchangeRateValue;

    /** @var string */
    protected $exchangeRateType;

    /** @var AbstractOtherReceiptLine[] */
    protected $lines;

    /**
     * Get receipt date
     *
     * @return DateType
     */
    public function getReceiptDate()
    {
        return $this->receiptDate;
    }

    /**
     * Set receipt date
     *
     * @param DateType $receiptDate
     */
    public function setReceiptDate($receiptDate)
    {
        $this->receiptDate = $receiptDate;
    }

    /**
     * Get payer
     *
     * @return string
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set payer
     *
     * @param string $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * Get payment method
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set payment method
     *
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Get transaction date
     *
     * @return DateType
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * Set transaction date
     *
     * @param DateType $transactionDate
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }

    /**
     * Get transaction number
     *
     * @return string
     */
    public function getTransactionNo()
    {
        return $this->transactionNo;
    }

    /**
     * Set transaction number
     *
     * @param string $transactionNo
     */
    public function setTransactionNo($transactionNo)
    {
        $this->transactionNo = $transactionNo;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get attachments ID
     *
     * @return string
     */
    public function getAttachmentsId()
    {
        return $this->attachmentsId;
    }

    /**
     * Set attachments ID
     *
     * @param string $attachmentsId
     */
    public function setAttachmentsId($attachmentsId)
    {
        $this->attachmentsId = $attachmentsId;
    }

    /**
     * Get bank account ID
     *
     * @return string
     */
    public function getBankAccountId()
    {
        return $this->bankAccountId;
    }

    /**
     * Set bank account ID
     *
     * @param string $bankAccountId
     */
    public function setBankAccountId($bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * Get deposit date
     *
     * @return DateType
     */
    public function getDepositDate()
    {
        return $this->depositDate;
    }

    /**
     * Set deposit date
     *
     * @param DateType $depositDate
     */
    public function setDepositDate($depositDate)
    {
        $this->depositDate = $depositDate;
    }

    /**
     * Get undeposited funds GL account number
     *
     * @return string
     */
    public function getUndepositedFundsGlAccountNo()
    {
        return $this->undepositedFundsGlAccountNo;
    }

    /**
     * Set undeposited funds GL account number
     *
     * @param string $undepositedFundsGlAccountNo
     */
    public function setUndepositedFundsGlAccountNo($undepositedFundsGlAccountNo)
    {
        $this->undepositedFundsGlAccountNo = $undepositedFundsGlAccountNo;
    }

    /**
     * Get transaction currency
     *
     * @return string
     */
    public function getTransactionCurrency()
    {
        return $this->transactionCurrency;
    }

    /**
     * Set transaction currency
     *
     * @param string $transactionCurrency
     */
    public function setTransactionCurrency($transactionCurrency)
    {
        $this->transactionCurrency = $transactionCurrency;
    }

    /**
     * Get exchange rate date
     *
     * @return DateType
     */
    public function getExchangeRateDate()
    {
        return $this->exchangeRateDate;
    }

    /**
     * Set exchange rate date
     *
     * @param DateType $exchangeRateDate
     */
    public function setExchangeRateDate($exchangeRateDate)
    {
        $this->exchangeRateDate = $exchangeRateDate;
    }

    /**
     * Get exchange rate value
     *
     * @return float
     */
    public function getExchangeRateValue()
    {
        return $this->exchangeRateValue;
    }

    /**
     * Set exchange rate value
     *
     * @param float $exchangeRateValue
     */
    public function setExchangeRateValue($exchangeRateValue)
    {
        $this->exchangeRateValue = $exchangeRateValue;
    }

    /**
     * Get exchange rate type
     *
     * @return string
     */
    public function getExchangeRateType()
    {
        return $this->exchangeRateType;
    }

    /**
     * Set exchange rate type
     *
     * @param string $exchangeRateType
     */
    public function setExchangeRateType($exchangeRateType)
    {
        $this->exchangeRateType = $exchangeRateType;
    }

    /**
     * Get other receipt lines
     *
     * @return AbstractOtherReceiptLine[]
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * Set other receipt lines
     *
     * @param AbstractOtherReceiptLine[] $lines
     */
    public function setLines($lines)
    {
        $this->lines = $lines;
    }
}
