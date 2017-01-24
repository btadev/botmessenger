<?php

namespace ChienIT\BotMessenger\Cache;

use Redis;
use RuntimeException;
use ChienIT\BotMessenger\Interfaces\CacheInterface;

/**
 * Redis <http://redis.io> cache backend
 * Requires phpredis native extension <https://github.com/phpredis/phpredis#installation>.
EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF
