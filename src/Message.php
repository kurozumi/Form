<?php
namespace Kurozumi\Form;

class Message implements \ArrayAccess, \Countable, \IteratorAggregate
{

	private $container = array();

	public function count($mode = 'COUNT_NORMAL')
	{
		return count($this->container);

	}

	public function offsetSet($offset, $value)
	{
		if (is_null($offset))
		{
			$this->container[] = $value;
		}
		else
		{
			$this->container[$offset] = $value;
		}

	}

	public function offsetExists($offset)
	{
		return isset($this->container[$offset]);

	}

	public function offsetUnset($offset)
	{
		unset($this->container[$offset]);

	}

	public function offsetGet($offset)
	{
		return isset($this->container[$offset]) ? $this->container[$offset] : null;

	}

	public function getIterator()
	{
		return new \ArrayIterator($this->container);
	}

}
