<?php

namespace Afaqy\Integration\Helpers;

class Tracer
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $error_body = [];

    /**
     * @var int|null
     */
    protected $error_code = null;

    /**
     * @var string
     */
    protected $error_message = null;

    /**
     * @var array
     */
    protected $success_data = [];

    /**
     * @var array
     */
    protected $success_body = [];

    /**
     * @var string
     */
    protected $success_message = null;

    /**
     * @var string|null
     */
    protected $area = null;

    /**
     * @var string|null
     */
    protected $unit_identifier = null;

    /**
     * @param array $errors
     * @return void
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $error_body
     * @return void
     */
    public function setErrorBody(array $error_body)
    {
        $this->error_body = $error_body;
    }

    /**
     * @return array
     */
    public function getErrorBody()
    {
        if ($this->error_body) {
            return $this->error_body;
        }

        return (array) ($this->errors['errors'] ?? []);
    }

    /**
     * @param string $message
     * @return void
     */
    public function setErrorMessge(string $message)
    {
        $this->error_message = $message;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        if ($this->error_message) {
            return $this->error_message;
        }

        return $this->errors['message'] ?? 'Operation failed!';
    }

    /**
     * @param int $code
     * @return void
     */
    public function setErrorCode(int $code)
    {
        $this->error_code = $code;
    }

    /**
     * @return int|null
     */
    public function getErrorCode()
    {
        if ($this->error_code) {
            return $this->error_code;
        }

        return $this->errors['code'] ?? $this->errors['ret'] ?? null;
    }

    /**
     * @param array $success_data
     * @return void
     */
    public function setSuccessData(array $success_data)
    {
        $this->success_data = $success_data;
    }

    /**
     * @return array
     */
    public function getSuccessData()
    {
        return $this->success_data;
    }

    /**
     * @param string $success_message
     * @return void
     */
    public function setSuccessMessge(string $success_message)
    {
        $this->success_message = $success_message;
    }

    /**
     * @return string
     */
    public function getSuccessMessage()
    {
        if ($this->success_message) {
            return $this->success_message;
        }

        return $this->success_data['message'] ?? 'Success operation.';
    }

    /**
     * @param array $success_body
     * @return void
     */
    public function setSuccessBody(array $success_body)
    {
        $this->success_body = $success_body;
    }

    /**
     * @return array
     */
    public function getSuccessBody()
    {
        if ($this->success_body) {
            return (array) $this->success_body;
        }

        return (array) ($this->success_data['data'] ?? []);
    }

    /**
     * @param string $area
     * @return void
     */
    public function setArea(string $area)
    {
        $this->area = $area;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        if ($this->area) {
            return $this->area;
        }

        return $this->success_data['data']['area']
        ?? $this->errors['errors']['area']
        ?? null;
    }

    /**
     * @param array $unit_identifier
     * @return void
     */
    public function setUnitIdentifier(string $unit_identifier)
    {
        $this->unit_identifier = $unit_identifier;
    }

    /**
     * @return string
     */
    public function getUnitIdentifier()
    {
        if ($this->unit_identifier) {
            return $this->unit_identifier;
        }

        return $this->success_data['data']['unit']['plate_number']
        ?? $this->errors['errors']['unit_identifier']
        ?? request()->car_number
        ?? request()->card_number
        ?? request()->qr_number
        ?? null;
    }
}
