<?php declare(strict_types=1);

namespace Stefna\Config;

use Stefna\Config\Exception\FileNotFound;

final class FileConfig implements Config
{
	use GetConfigTrait;

	/** @var array<string, mixed> */
	private array $configData;

	public function __construct(
		private readonly string $configFile,
	) {}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->configData)) {
			return $this->configData[$key] ?? null;
		}

		if (!file_exists($this->configFile)) {
			throw new FileNotFound('Configuration not found: ' . $this->configFile);
		}
		$this->configData = require $this->configFile;

		return $this->configData[$key] ?? null;
	}
}
