<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\Exception\FileNotFound;
use Stefna\Config\FileConfig;

final class FileConfigTest extends TestCase
{
	public function testFileNotFound(): void
	{
		$config = $this->getConfig('not-found.php');

		$this->expectException(FileNotFound::class);

		$config->get('test-key');
	}

	public function testLoadFileConfig(): void
	{
		$config = $this->getConfig('test-config.php');

		$this->assertSame(42, $config->getInt('testNumber'));
		$this->assertSame('42', $config->get('testNumber'));
	}

	private function getConfig(string $file): FileConfig
	{
		return new FileConfig(__DIR__ . '/resources/' . $file);
	}
}
