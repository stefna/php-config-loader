<?php declare(strict_types=1);

namespace Moya\Config;

final class FileConfig implements Config
{
	use GetConfigTrait;

	/** @var array<string, mixed> */
	private array $configData;

	public function __construct(
		private readonly string $configFile,
	) {}

	/**
	 * @return array<string, mixed>
	 */
	protected function getRawConfigArray(): array
	{
		if (!isset($this->configData)) {
			if (!file_exists($this->configFile)) {
				throw new \RuntimeException('Configuration not found: ' . $this->configFile);
			}
			$this->configData = require $this->configFile;
		}

		return $this->configData;
	}
}
