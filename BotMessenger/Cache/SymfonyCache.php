<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;

class SymfonyCache extends Psr6Cache
{
    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
}
