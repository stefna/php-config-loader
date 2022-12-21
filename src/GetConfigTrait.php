<?php declare(strict_types=1);

namespace Moya\Config;

trait GetConfigTrait
{
	/**
	 * @return array<string, mixed>
	 */
	abstract protected function getRawConfigArray(): array;

	public function get(string $key, mixed $default = null): mixed
	{
		$data = $this->getRawConfigArray();
		return $data[$key] ?? null;
	}

	public function has(string $key): bool
	{
		return isset($this->getRawConfigArray()[$key]);
	}

	public function getString(string $key, ?string $default = null): ?string
	{
		$value = $this->getRawConfigArray()[$key] ?? $default;
		if (!is_scalar($value)) {
			return $default;
		}
		return (string)$value;
	}

	public function getInt(string $key, ?int $default = null): ?int
	{
		$value = $this->getRawConfigArray()[$key] ?? $default;
		if (is_numeric($value)) {
			return (int)$value;
		}
		return $default;
	}

	public function getFloat(string $key, ?float $default = null): ?float
	{
		$value = $this->getRawConfigArray()[$key] ?? $default;
		if (is_numeric($value)) {
			return (float)$value;
		}
		return $default;
	}

	public function getBool(string $key, ?bool $default = null): ?bool
	{
		$value = $this->getRawConfigArray()[$key] ?? $default;
		if (is_bool($value) || $value === null) {
			return $value;
		}

		if (!is_scalar($value)) {
			return $default;
		}

		return in_array($value, [
			1,
			'1',
			'on',
			'true',
		], true);
	}

	/**
	 * @param array<string, mixed> $default
	 * @return array<string, mixed>
	 */
	public function getArray(string $key, array $default = []): array
	{
		$value = $this->getRawConfigArray()[$key] ?? $default;
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
