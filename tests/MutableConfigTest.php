<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\ArrayConfig;
use Stefna\Config\MutableConfig;
use Stefna\Config\Tests\Stub\TestStub;

final class MutableConfigTest extends AbstractConfigTestCase
{
	public function testOverrideValue(): void
	{
		$config = $this->getConfig();
		$key = 'testString';
		$originalValue = $config->get($key);
		$newValue = 'overrideValue';

		$config->setConfigValue($key, $newValue);

		$this->assertNotSame($originalValue, $newValue);
		$this->assertSame($newValue, $config->getString($key));
	}

	public function testOverrideDotKeyValues(): void
	{
		$config = $this->getConfig();
		$key = 'deep.nesting.int';
		$originalValue = $config->get($key);
		$newValue = 42;

		$config->setConfigValue($key, $newValue);

		$this->assertNotSame($originalValue, $newValue);
		$this->assertSame($newValue, $config->getInt($key));
	}

	public function testOverrideTestValue(): void
	{
		$config = $this->getConfig();
		$key = 'nesting.test';
		$originalValue = $config->get($key);
		$newValue = 'overrideValue';

		$config->setConfigValue($key, $newValue);

		$this->assertNotSame($originalValue, $newValue);
		$this->assertSame($newValue, $config->get($key));

		$config->resetConfigValue($key);

		$this->assertSame($originalValue, $config->get($key));
	}

	public function getConfig(): MutableConfig
	{
		return new MutableConfig($this->getDefaultArrayConfig());
	}
}
