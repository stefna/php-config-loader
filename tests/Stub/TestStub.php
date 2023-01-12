<?php declare(strict_types=1);

namespace Stefna\Config\Tests\Stub;

final class TestStub
{
	/**
	 * @param array{random: string} $data
	 */
	public static function fromArray(array $data): self
	{
		return new self((int)$data['random']);
	}

	public function __construct(
		public readonly int $random,
	) {}
}
