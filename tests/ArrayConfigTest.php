<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\ArrayConfig;

final class ArrayConfigTest extends TestCase
{
	/**
	 * @dataProvider stringValues
	 */
	public function testGetAsString(string $key, mixed $expected): void
	{
		$config = $this->getConfig();

		$this->assertSame($expected, $config->getString($key));
	}

	public function getConfig(): ArrayConfig
	{
		return new ArrayConfig([
			'testString' => 'string',
			'testNumberAsString' => '43',
			'testNumber' => 42,
			'testBool' => true,
			'testBoolAsString' => 'on',
			'testArray' => [
				'random' => '1',
			],
		]);
	}

	/**
	 * @return list<array{string, mixed}>
	 */
	public function stringValues(): array
	{
		return [
			['testString', 'string'],
			['testNumber', '42'],
			['testBool', '1'],
			['testBoolAsString', 'on'],
			['testArray', null],
			['not-found', null],
		];
	}
}
