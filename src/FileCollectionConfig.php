<?php declare(strict_types=1);

namespace Stefna\Config;

use Stefna\Config\Exception\ConfigLocked;
use Stefna\Config\Exception\FileNotFound;

final class FileCollectionConfig implements Config
{
	use GetConfigTrait;

	/** @var string[] */
	private array $files = [];
	/** @var array<string, mixed> */
	private array $configData;

	public function __construct(
		private readonly string $configPath,
	) {}

	public function addFile(string $file): void
	{
		if (isset($this->configData)) {
			throw new ConfigLocked("Can't add more files after config have been loaded");
		}
		$this->files[] = $file;
	}

	public function getRawValue(string $key): mixed
	{
		if (isset($this->configData)) {
			return $this->configData[$key] ?? null;
		}

		$configs = [];
		foreach ($this->files as $configFile) {
			if (!file_exists($this->configPath . $configFile)) {
				throw new FileNotFound('Configuration not found: ' . $this->configPath . $configFile);
			}
			$configs[] = require $this->configPath . $configFile;
		}
		$this->files = [];
		$this->configData = array_merge(...$configs);

		return $this->configData[$key] ?? null;
	}
}
