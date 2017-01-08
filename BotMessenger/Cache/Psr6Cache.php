<?php

namespace ChienIT\BotMessenger\Cache;

use Psr\Cache\CacheItemPoolInterface;
use ChienIT\BotMessenger\Interfaces\CacheInterface;

class Psr6Cache implements CacheInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $adapter;

    /**
     * @param CacheItemPoolInterface $adapter
     */
    public function __construct(CacheItemPoolInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return $this->adapter->hasItem($key);
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        $item = $this->adapter->getItem($key);
        if ($item->isHit()) {
            return $item->get();
        }

        return $default;
    }

    /**
     * @param string $key
     * @param null $default
     * @return null
     */
    public function pull($key, $default = null)
    {
        $item = $this->adapter->getItem($key);
        if ($item->isHit()) {
            $this->adapter->deleteItem($key);

            return $item->get();
        }

        return $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param \DateTime|int $minutes
     */
    public function put($key, $value, $minutes)
    {
    public function getConversationAnswer(IncomingMessage $message);
