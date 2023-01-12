<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\ArrayConfig;
use Stefna\Config\Tests\Stub\TestStub;

final class ArrayConfigTest extends TestCase
{
	public function testGetArrayObject(): void
	{
		$config = $this->getConfig();

		$obj = $config->getArrayAsObject('testArray', TestStub::class);

		$this->assertInstanceOf(TestStub::class, $obj);
		$this->assertSame(1, $obj->random);
	}

	public function testGetArrayObjectWithInvalidClass(): void
	{
		$config = $this->getConfig();

		$this->expectException(\BadMethodCallException::class);

		$config->getArrayAsObject('testArray', \ArrayObject::class);
	}

	public function testGetArray(): void
	{
		$config = $this->getConfig();

		$arr = $config->getArray('testArray');

		$this->assertIsArray($arr);
		$this->assertSame('1', $arr['random']);
	}

	public function testGetArrayWithDefaultValue(): void
	{
		$config = $this->getConfig();

		$arr = $config->getArray('not-found', ['number' => 1]);

		$this->assertIsArray($arr);
		$this->assertSame(1, $arr['number']);
	}

	public function testGetArrayWithInvalidValueReturnsEmptyArray(): void
	{
		$config = $this->getConfig();

		$arr = $config->getArray('testString');
		$this->assertEmpty($arr);
	}

	public function testGetArrayNotFoundEmptyArray(): void
	{
		$config = $this->getConfig();

		$arr = $config->getArray('not-found');
		$this->assertEmpty($arr);
	}

	public function testGet(): void
	{
		$config = $this->getConfig();

		$this->assertSame('string', $config->get('testString'));
	}

	public function testGetWithDefault(): void
	{
		$config = $this->getConfig();

		$this->assertSame(1, $config->get('not-found', 1));
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
}
