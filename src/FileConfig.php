<?php declare(strict_types=1);

namespace Stefna\Config;

use Stefna\Config\Exception\FileNotFound;

final class FileConfig implements Config
{
	use GetConfigTrait;

	private ArrayConfig $loadedConfig;

	public function __construct(
		private readonly string $configFile,
	) {}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->loadedConfig)) {
			return $this->loadedConfig->getRawValue($key);
		}

		if (!file_exists($this->configFile)) {
			throw new FileNotFound('Configuration not found: ' . $this->configFile);
		}
		$this->loadedConfig = ArrayConfig::fromArray(require $this->configFile);

		return $this->loadedConfig->getRawValue($key);
	}
}
