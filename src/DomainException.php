<?php

namespace Exceptions;

/**
 *
 * @author Andrei Pirjoleanu <andreipirjoleanu@gmail.com>
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
	protected $code = 10400;

	/**
	 * The exception string code
	 *
	 * @var string
	 */
	protected $stringCode = 'DOMAIN';

	/**
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
		if (is_string($providedValue)) {
			$this->providedValue = $providedValue;
		} else {
			$this->providedValue = json_encode($providedValue);
		}
	}

	/**
	 * Set the current domain that should contain the provided value
	 *
	 * @param string $currentDomain
	 */
	protected function setCurrentDomain($currentDomain)
	{
		if (is_string($currentDomain)) {
			$this->currentDomain = $currentDomain;
		} else {
			$this->currentDomain = json_encode($currentDomain);
		}
	}

	/**
	 * Set the additional parameters in the message
	 */
	protected function setMessage()
	{
		$message = sprintf($this->message, $this->providedValue, $this->currentDomain);

		$this->message = $message;
	}

}

?>