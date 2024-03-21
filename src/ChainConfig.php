<?php declare(strict_types=1);

namespace Stefna\Config;

final class ChainConfig implements Config
{
	use GetConfigTrait;

	/** @var array<string, mixed> */
	private array $cache = [];
	/** @var Config[] */
	private array $configs;

	public function __construct(
		Config ...$configs,
	) {
		$this->configs = $configs;
	}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->cache[$key])) {
			return $this->cache[$key];
		}
		foreach ($this->configs as $config) {
			if ($config->has($key)) {
				return $this->cache[$key] = $config->get($key);
			}
		}
		return null;
	}
}
