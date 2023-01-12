<?php declare(strict_types=1);

namespace Stefna\Config;

use Stefna\Collection\ScalarMapTrait;

trait GetConfigTrait
{
	use ScalarMapTrait;

	public function get(string $key, mixed $default = null): mixed
	{
		return $this->getRawValue($key) ?? $default;
	}

	/**
	 * @param array<string, mixed> $default
	 * @return array<string, mixed>
	 */
	public function getArray(string $key, array $default = []): array
	{
		$value = $this->getRawValue($key) ?? $default;
		if (!is_array($value)) {
			return $default;
		}

		return $value;
	}

	/**
	 * @template T of object
	 * @param class-string<T> $object
	 * @return T
	 */
	public function getArrayAsObject(string $key, string $object): object
	{
		if (!method_exists($object, 'fromArray')) {
			throw new \BadMethodCallException('Class don\'t support creation from array. Please implement fromArray');
		}
		$value = $this->getArray($key);

		return $object::fromArray($value);
	}
}
