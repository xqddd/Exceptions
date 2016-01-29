<?php
namespace Xqddd\Exceptions;

/**
 * Exception thrown if a value does not adhere to a defined valid data domain.
 *
 * @author Andrei Pirjoleanu <andreipirjoleanu@gmail.com>
 * @package Xqddd\Exceptions
 */
class DomainException extends \DomainException
{

    /**
     * The provided value that caused the exception
     *
     * @var string
     */
    protected $providedValue = 'unknown';

    /**
     * The current domain that should contain the provided value
     *
     * @var string
     */
    protected $currentDomain = 'unknown';

    /**
     * The exception message
     *
     * @var string
     */
    protected $message = 'The provided value [%s] does not exist or does not belong to the current domain [%s].';

    /**
     * The exception code
     *
     * @var int
     */
    protected $code = Codes::DOMAIN;

    /**
     * The exception string code
     *
     * @var string
     */
    protected $stringCode = 'DOMAIN';

    /**
     * DomainException constructor.
     *
     * @param string $providedValue The provided value that caused the exception
     * @param string $currentDomain The current domain that should contain the provided value
     * @param string $previous The previous exception, if any
     */
    public function __construct($providedValue, $currentDomain, $previous = null)
    {
        $this->setProvidedValue($providedValue);
        $this->setCurrentDomain($currentDomain);

        $this->setMessage();

        parent::__construct($this->message, $this->code, $previous);
    }

    /**
     * Set the provided value that caused the exception
     *
     * @param string $providedValue
     */
    protected function setProvidedValue($providedValue)
    {
        $this->providedValue = (is_string($providedValue) ? $providedValue : json_encode($providedValue));
    }

    /**
     * Set the current domain that should contain the provided value
     *
     * @param string $currentDomain
     */
    protected function setCurrentDomain($currentDomain)
    {
        $this->currentDomain = (is_string($currentDomain) ? $currentDomain : json_encode($currentDomain));
    }

    /**
     * Set the additional parameters in the message
     */
    protected function setMessage()
    {
        $this->message = sprintf($this->message, $this->providedValue, $this->currentDomain);
    }

    /**
     * Get the exception string code
     *
     * @return string
     */
    public function getStringCode()
    {
        return $this->stringCode;
    }
}
