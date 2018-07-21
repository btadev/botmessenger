<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Middleware;

use ChienIT\BotMessenger\BotMessenger;
use ChienIT\BotMessenger\Interfaces\Middleware\Sending;

class MsgSmart implements Sending
{
    protected $vars = [];

    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param BotMessenger $bot
     * @param $next
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMessenger $bot)
    {
        $this->vars = $bot->getUser()->getInfo();
        $this->loop($payload['message']);
        return $next($payload);
    }

    protected function loop(&$msg) {
        if(is_string($msg)) {
            return $this->fix($msg);
        } elseif(is_array($msg)) {
            foreach($msg as &$m) {
                $this->loop($m);
            }
        }
    }

    protected function fix(&$msg) {
        preg_match_all('/\{\{([A-Za-z\_]*)\}\}/', $msg, $match);
        if(!empty($match[1]))
            foreach(array_unique($match[1]) as $var) {
                $value = '{'.$var.'_UNDEFINED}';
                if(!empty($this->vars[$var])) $value = $this->vars[$var];
                $msg = str_replace('{{'.$var.'}}', $value, $msg);
            }
    }
}
