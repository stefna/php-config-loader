<?php declare(strict_types=1);

namespace Stefna\Config;

final class MutableConfig implements Config
{
	use GetConfigTrait;

	/** @var array<string, mixed> */
	private array $config = [];

	public function __construct(
		private readonly Config $rootConfig,
	) {}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}
		return $this->rootConfig->get($key);
	}

	public function setConfigValue(string $key, mixed $value): void
	{
		$this->config[$key] = $value;
	}

	public function resetConfigValue(string $key): void
	{
		unset($this->config[$key]);
	}
}
