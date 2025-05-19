<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\ArrayConfig;
use Stefna\Config\ChainConfig;
use Stefna\Config\Tests\Stub\TestStub;

final class ChainConfigTest extends AbstractConfigTestCase
{
	public function testGetValueFromSecondConfigArray(): void
	{
		$config = $this->getConfig();

		$this->assertTrue($config->get('secondConfig.nest'));
		$this->assertTrue($config->get('secondConfig.nest'));
	}

	public function getConfig(): ChainConfig
	{
		return new ChainConfig(
			$this->getDefaultArrayConfig(),
			new ArrayConfig([
				'secondConfig' => [
					'nest' => true,
				],
			])
		);
	}
}
