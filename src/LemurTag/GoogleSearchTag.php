<?php
namespace LemurEngine\GoogleSearch\LemurTag;

use LemurEngine\LemurBot\Classes\LemurLog;
use LemurEngine\LemurBot\LemurTag\AimlTag;
use LemurEngine\LemurBot\Models\Conversation;

/**
 * Class Googlesearch
 * @package LemurEngine\LemurBot\LemurTag\Custom
 *
 * Usage: <googlesearch>Cake Recipe</googlesearch>
 *
 * Example AIML:
 * <category>
 *  <pattern>SEARCH GOOGLE FOR A *</pattern>
 *  <template><googlesearch><star /></googlesearch</template>
 * </category>
 *
 * Expected Conversation:
 * Input: Search google for a cake recipe
 * Output: Check these search results: <a href="https://www.google.com/search?q=cake+recipe" target="_new">cake recipe</a>
 *
 * Documentation:
 * https://docs.lemurbot.com/extend.html
 *
 */
class GoogleSearchTag extends AimlTag
{
    protected string $tagName = "GoogleSearch";
    //this is a standard tag
    static $aimlTagType = self::TAG_STANDARD;


    /**
     * GooglesearchTag Constructor.
     * @param Conversation $conversation
     * @param array $attributes
     */
    public function __construct(Conversation $conversation, array $attributes = [])
    {
        parent::__construct($conversation, $attributes);
    }


    /**
     * This method is called when the closing tag is encountered e.g. </googlesearch>
     * @return string|void
     */
    public function closeTag()
    {
        LemurLog::debug(
            __FUNCTION__, [
                'conversation_id'=>$this->conversation->id,
                'turn_id'=>$this->conversation->currentTurnId(),
                'tag_id'=>$this->getTagId(),
                'attributes'=>$this->getAttributes()
            ]
        );

        //gets the current content of the tag e.g. what currently exists in <googlesearch>something</googlesearch> (something)
        $tagContents = $this->getCurrentTagContents(true);

        //build the string for the response..
        $urlEncodedTagContents = urlencode($tagContents);
        $responseStr = "Check these search results: <a href=\"https://www.google.com/search?q=".$urlEncodedTagContents."\" target=\"_new\">".$tagContents."</a>";

        //build response in the stack
        $this->buildResponse($responseStr);
    }
}
