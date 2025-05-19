<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\ArrayConfig;
use Stefna\Config\Tests\Stub\TestStub;

final class ArrayConfigTest extends AbstractConfigTestCase
{
	public function getConfig(): ArrayConfig
	{
		return $this->getDefaultArrayConfig();
	}
}
