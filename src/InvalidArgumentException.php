<?php
namespace Xqddd\Exceptions;

/**
 * Exception thrown if an argument does not match with the expected value.
 *
 * @author Andrei Pirjoleanu <andreipirjoleanu@gmail.com>
 * @package Xqddd/Exceptions
 */
class InvalidArgumentException extends \InvalidArgumentException
{

    /**
     * The name of the invalid argument that caused the exception
     *
     * @var string
     */
    protected $argumentName = 'unknown';

    /**
     * The expected type of the invalid argument
     *
     * @var string
     */
    protected $expected = 'unknown';

    /**
     * The actual type of the invalid argument that has been given
     *
     * @var string
     */
    protected $actual = 'unknown';

    /**
     * The exception message
     *
     * @var string
     */
    protected $message = 'Invalid [%s] argument: [%s] expected - [%s] given.';

    /**
     * The exception code
     *
     * @var int
     */
    protected $code = Codes::INVALID_ARGUMENT;

    /**
     * The exception string code
     *
     * @var string
     */
    protected $stringCode = 'INVALID_ARGUMENT';

    /**
     * InvalidArgumentException constructor.
     *
     * @param string $argumentName The name of the invalid argument that caused the exception
     * @param string $expected The expected type of the invalid argument
     * @param string $actual The actual type of the invalid argument that has been given
     * @param string $previous The previous exception, if any
     */
    public function __construct($argumentName, $expected, $actual, $previous = null)
    {
        $this->setArgumentName($argumentName);
        $this->setExpected($expected);
        $this->setActual($actual);

        $this->setMessage();

        parent::__construct($this->message, $this->code, $previous);
    }

    /**
     * Set the name of the invalid argument that caused the exception
     *
     * @param string $argumentName
     */
    protected function setArgumentName($argumentName)
    {
        $this->argumentName = (is_string($argumentName) ? $argumentName : json_encode($argumentName));
    }

    /**
     * Set the expected type of the invalid argument
     *
     * @param string $expected
     */
    protected function setExpected($expected)
    {
        $this->expected = (is_string($expected) ? $expected : json_encode($expected));
    }

    /**
     * Set the actual type of the invalid argument that has been given
     *
     * @param string $actual
     */
    protected function setActual($actual)
    {
        $this->actual = (is_string($actual) ? $actual : json_encode($actual));
    }

    /**
     * Set the additional parameters in the message
     */
    protected function setMessage()
    {
        $this->message = sprintf($this->message, $this->argumentName, $this->expected, $this->actual);
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
