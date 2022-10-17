<?php namespace LemurEngine\GoogleSearch\Tests;

use LemurEngine\LemurBot\Models\Conversation;
use LemurEngine\LemurBot\LemurTag\SentenceTag;
use Mockery;
use Tests\TagTestCase;

class GoogleSearchTagTest extends TagTestCase
{
    protected $parser;
    protected $mock;
    protected Mockery\LegacyMockInterface|Conversation|Mockery\MockInterface $conversation;
    protected $turn;
    protected $tag;

    public function setUp() :void
    {

        //some common parts of the conversation
        //are set up in the parent TagTestCase constructor
        parent::setUp();

        $this->conversation->shouldReceive('debug');

        $this->conversation->shouldReceive('getAttribute')
            ->withArgs(['bot_id'])->andReturn(1);

        $this->conversation->shouldReceive('getAttribute')
            ->withArgs(['client_id'])->andReturn(1);

        $this->tag = new SentenceTag($this->conversation, []);
    }


    /**
     * @return void
     */
    public function testGetTagName()
    {
        $this->assertEquals('GoogleSearch', $this->tag->getTagName());
    }



    /**
     * test Bot::closeTag()
     *
     * @return void
     */
    public function testCloseTagSingleSentence()
    {
        $this->tag->buildResponse('make sentence');
        $this->tag->closeTag();
        $this->assertEquals('Make sentence', $this->tag->getCurrentTagContents());
    }

    /**
     * test Bot::closeTag()
     *
     * @return void
     */
    public function testCloseTagMultipleTagContents()
    {
        $this->tag->buildResponse('make sentence one');
        $this->tag->buildResponse('make sentence two');
        $this->tag->closeTag();
        $this->assertEquals('Make sentence one make sentence two', $this->tag->getCurrentTagContents());
    }

    /**
     *
     */
    public function tearDown() :void
    {
        parent::tearDown();
    }
}
