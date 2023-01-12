<?php declare(strict_types=1);

namespace Stefna\Config;

use Stefna\Collection\ScalarMap;

interface Config extends ScalarMap
{
	public function get(string $key, mixed $default = null): mixed;

	/**
	 * @param mixed[] $default
	 * @return mixed[]
	 */
	public function getArray(string $key, array $default = []): array;

	/**
	 * @template T of object
	 * @param class-string<T> $object
	 * @return T
	 */
	public function getArrayAsObject(string $key, string $object): object;
}
