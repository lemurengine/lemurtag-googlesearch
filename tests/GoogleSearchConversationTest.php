<?php namespace LemurEngine\GoogleSearch\Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;
use LemurEngine\GoogleSearch\Seeders\GoogleSearchTagTestSeeder;
use LemurEngine\LemurBot\Classes\LemurLog;
use LemurEngine\LemurBot\Classes\TagStack;

class GoogleSearchConversationTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware;

    protected static $initialized = false;

    protected static $clientId = false;

    public function setUp() :void
    {
        parent::setUp();

        $this->artisan('config:clear');
        $this->artisan('cache:clear');
        $this->artisan('route:clear');
        $this->artisan('key:generate ');

        if (!self::$initialized) {
            // set the client id
            self::$clientId = uniqid('test', false);
            $this->seed([
                GoogleSearchTagTestSeeder::class,
            ]);
            //protect so it doesnt run again
            self::$initialized = true;
        }
    }


    public function testMakeCategoryGroupsCreated()
    {
        $this->assertDatabaseHas('category_groups', ['slug'=>'unit-google-search-categories']);
    }

    public function testMakeCategoriesCreated()
    {
        $this->assertDatabaseHas('categories', ['slug'=>'unit-google-search-1']);
    }


    /**
     * @test
     * @dataProvider inputOutput
     */
    public function testSimpleConversation($input, $expected)
    {

            $data = [
                'client'=>self::$clientId,
                'bot' => 'testy',
                'html' => '1',
                'message' => $input];

            LemurLog::info("test data in ($input)", $data);

            $response = $this->post('/api/talk/bot', $data);
            $arr = json_decode($response->content(), true);
            $response->assertStatus(200);
            $this->assertTrue($arr['success']);
            $this->assertIsString(
                $arr['data']['conversation']['output']
            );
            $this->assertEquals(
                $expected,
                $arr['data']['conversation']['output']
            );
    }


    public function inputOutput()
    {
        $this->refreshApplication();

        return [
            'test line:'.__LINE__=>['Search google for a cake recipe', 'Check these search results: <a href="https://www.google.com/search?q=cake+recipe" target="_new">cake recipe</a>'],
        ];
    }
    /**
     *
     */
    public function tearDown() :void
    {

        $config = app('config');
        TagStack::getInstance()->destroy();
        $this->artisan('config:clear');
        $this->artisan('cache:clear');
        $this->artisan('route:clear');
        parent::tearDown();
        app()->instance('config', $config);
    }
}
