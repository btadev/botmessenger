<?php

namespace ChienIT\BotMessenger\Messages\Conversations;

use Closure;
use ChienIT\BotMessenger\BotMessenger;
use Spatie\Macroable\Macroable;
use Illuminate\Support\Collection;
use ChienIT\BotMessenger\Interfaces\ShouldQueue;
use ChienIT\BotMessenger\Messages\Attachments\Audio;
use ChienIT\BotMessenger\Messages\Attachments\Image;
use ChienIT\BotMessenger\Messages\Attachments\Video;
use ChienIT\BotMessenger\Messages\Outgoing\Question;
use ChienIT\BotMessenger\Messages\Attachments\Location;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

/**
 * Class Conversation.
 */
abstract class Conversation
{
    use Macroable;

    /**
     * @var BotMessenger
     */
    protected $bot;

    /**
     * @var string
     */
    protected $token;

    /**
     * Number of minutes this specific conversation should be cached.
     * @var int
     */
    protected $cacheTime;

    /**
     * @param BotMessenger $bot
     */
    public function setBot(BotMessenger $bot)
    {
        $this->bot = $bot;
    }

    /**
     * @return BotMessenger
     */
    public function getBot()
    {
        return $this->bot;
    }

    /**
     * @param string|Question $question
     * @param array|Closure $next
     * @param array $additionalParameters
     * @return $this
     */
    public function ask($question, $next, $additionalParameters = [])
    {
        $this->bot->reply($question, $additionalParameters);
        $this->bot->storeConversation($this, $next, $question, $additionalParameters);

        return $this;
    }

    /**
     * @param string|\ChienIT\BotMessenger\Messages\Outgoing\Question $question
     * @param array|Closure $next
     * @param array|Closure $repeat
     * @param array $additionalParameters
     * @return $this
     */
    public function askForImages($question, $next, $repeat = null, $additionalParameters = [])
    {
        $additionalParameters['__getter'] = 'getImages';
        $additionalParameters['__pattern'] = Image::PATTERN;
        $additionalParameters['__repeat'] = ! is_null($repeat) ? $this->bot->serializeClosure($repeat) : $repeat;

        return $this->ask($question, $next, $additionalParameters);
    }

    /**
     * @param string|\ChienIT\BotMessenger\Messages\Outgoing\Question $question
