<?php declare(strict_types=1);

namespace Moya\Config;

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
			throw new \BadMethodCallException("Can't add more files after config have been loaded");
		}
		$this->files[] = $file;
	}

	protected function getRawValue(string $key): mixed
	{
		if (isset($this->configData)) {
			return $this->configData[$key] ?? null;
		}

		$configs = [];
		foreach ($this->files as $configFile) {
			if (!file_exists($this->configPath . $configFile)) {
				throw new \RuntimeException('Configuration not found: ' . $this->configPath . $configFile);
			}
			$configs[] = require $this->configPath . $configFile;
		}
		$this->files = [];
		$this->configData = array_merge(...$configs);

		return $this->configData[$key] ?? null;
	}
}
