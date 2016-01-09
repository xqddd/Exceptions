<?php

namespace Xqddd\Exceptions;

/**
 *
 * @author Andrei Pirjoleanu <andreipirjoleanu@gmail.com>
 * @package Exceptions
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
        if (is_string($argumentName)) {
            $this->argumentName = $argumentName;
        } else {
            $this->argumentName = json_encode($argumentName);
        }
    }

    /**
     * Set the expected type of the invalid argument
     *
     * @param string $expected
     */
    protected function setExpected($expected)
    {
        if (is_string($expected)) {
            $this->expected = $expected;
        } else {
            $this->expected = json_encode($expected);
        }
    }

    /**
     * Set the actual type of the invalid argument that has been given
     *
     * @param string $actual
     */
    protected function setActual($actual)
    {
        if (is_string($actual)) {
            $this->actual = $actual;
        } else {
            $this->actual = json_encode($actual);
        }
    }

    /**
     * Set the additional parameters in the message
     */
    protected function setMessage()
    {
        $message = sprintf($this->message, $this->argumentName, $this->expected, $this->actual);

        $this->message = $message;
    }

}
