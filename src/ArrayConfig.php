<?php declare(strict_types=1);

namespace Stefna\Config;

final class ArrayConfig implements Config
{
	use GetConfigTrait;

	/**
	 * @param array<string, mixed> $data
	 */
	public static function fromArray(array $data): self
	{
		return new self($data);
	}

	public function __construct(
		/** @var array<string, mixed> */
		private readonly array $config,
	) {}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}
		if (!str_contains($key, '.')) {
			return null;
		}
		$keys = explode('.', $key);
		$root = $this->config;
		foreach ($keys as $searchKey) {
			if (!is_array($root) || !isset($root[$searchKey])) {
				return null;
			}
			$root = $root[$searchKey];
		}
		return $root;
	}
}
