<?php
namespace vakata\ids\test;

class IDSTest extends \PHPUnit_Framework_TestCase
{
	protected static $storage = null;

	public static function setUpBeforeClass() {
	}
	public static function tearDownAfterClass() {
	}
	protected function setUp() {
	}
	protected function tearDown() {
	}
	public function testRules()
	{
		$ids = new \vakata\ids\IDS([
			[ 'rule' => 'a', 'impact' => 1, 'tags' => ['a'] ],
			[ 'rule' => '^b', 'impact' => 10, 'tags' => ['b'] ]
		]);
		$this->assertEquals(0, $ids->analyzeData(['asdf' => 'c']));
		$this->assertEquals(1, $ids->analyzeData(['asdf' => 'a']));
		$this->assertEquals(10, $ids->analyzeData(['asdf' => 'b']));
		$this->assertEquals(11, $ids->analyzeData(['asdf' => 'ba']));
		$this->assertEquals(1, $ids->analyzeData(['asdf' => 'ba'], null, ['a']));
		$this->assertEquals(0, $ids->analyzeData(['asdf' => 'ba'], null, ['c']));
		$this->assertEquals(1, $ids->analyzeData(['asdf' => 'ba'], 1));
	}
	public function testDefaultRules()
	{
		$ids = \vakata\ids\IDS::fromDefaults();
		$this->assertEquals(8, $ids->analyzeData(['asdf' => 'c<script></script>']));
		$this->assertEquals(8, $ids->analyzeData(['asdf' => "%27+union+select+1+--"]));
	}
}
