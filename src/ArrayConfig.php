<?php declare(strict_types=1);

namespace Stefna\Config;

final class ArrayConfig implements Config
{
	use GetConfigTrait;

	public function __construct(
		/** @var array<string, mixed> */
		private readonly array $config,
	) {}

	protected function getRawValue(string $key): mixed
	{
		return $this->config[$key] ?? null;
	}
}
