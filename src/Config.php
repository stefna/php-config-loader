<?php declare(strict_types=1);

namespace Moya\Config;

interface Config
{
	public function get(string $key, mixed $default = null): mixed;
	public function has(string $key): bool;

	/**
	 * @phpstan-return ($default is string ? string : string|null)
	 */
	public function getString(string $key, ?string $default = null): ?string;
	/**
	 * @phpstan-return ($default is int ? int : int|null)
	 */
	public function getInt(string $key, ?int $default = null): ?int;
	/**
	 * @phpstan-return ($default is float ? float : float|null)
	 */
	public function getFloat(string $key, ?float $default = null): ?float;
	/**
	 * @phpstan-return ($default is bool ? bool : bool|null)
	 */
	public function getBool(string $key, ?bool $default = null): ?bool;

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
