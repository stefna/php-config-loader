<?php declare(strict_types=1);

namespace Moya\Config;

final class ArrayConfig implements Config
{
	use GetConfigTrait;

	public function __construct(
		/** @var array<string, mixed> */
		private readonly array $config,
	) {}

	/**
	 * @return array<string, mixed>
	 */
	protected function getRawConfigArray(): array
	{
		return $this->config;
	}
}
