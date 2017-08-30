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
     * @param mixed $payload
