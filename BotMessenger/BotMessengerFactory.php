<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger;

use React\Socket\Server;
use ChienIT\BotMessenger\Http\Curl;
use React\EventLoop\LoopInterface;
use ChienIT\BotMessenger\Cache\ArrayCache;
use ChienIT\BotMessenger\Drivers\DriverManager;
use ChienIT\BotMessenger\Interfaces\CacheInterface;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Interfaces\StorageInterface;
use ChienIT\BotMessenger\Storages\Drivers\FileStorage;

class BotMessengerFactory
{
    private static $extensions = [];

    /**
     * @param $methodName
     * @param $callable
     */
    public static function extend($methodName, $callable)
    {
        self::$extensions[$methodName] = $callable;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        try {
            return call_user_func_array(self::$extensions[$name], $arguments);
        } catch (\Exception $e) {
            throw new \BadMethodCallException("Method [$name] does not exist.");
        }
    }

    /**
     * Create a new BotMessenger instance.
     *
     * @param array $config
     * @param CacheInterface $cache
     * @param Request $request
     * @param StorageInterface $storageDriver
     * @return ChienIT\BotMessenger\BotMessenger
     */
    public static function create(
        array $config,
        CacheInterface $cache = null,
        Request $request = null,
        StorageInterface $storageDriver = null
    ) {
        if (empty($cache)) {
            $cache = new ArrayCache();
        }
        if (empty($request)) {
            $request = Request::createFromGlobals();
        }
        if (empty($storageDriver)) {
            $storageDriver = new FileStorage(__DIR__);
        }

        $driverManager = new DriverManager($config, new Curl());
        $driver = $driverManager->getMatchingDriver($request);

        return new BotMessenger($cache, $driver, $config, $storageDriver);
    }

    /**
     * Create a new BotMessenger instance that listens on a socket.
     *
     * @param array $config
     * @param LoopInterface $loop
     * @param CacheInterface $cache
     * @param StorageInterface $storageDriver
     * @return ChienIT\BotMessenger\BotMessenger
     */
    public static function createForSocket(
        array $config,
        LoopInterface $loop,
        CacheInterface $cache = null,
        StorageInterface $storageDriver = null
    ) {
        $port = isset($config['port']) ? $config['port'] : 8080;

        $socket = new Server($loop);

        if (empty($cache)) {
            $cache = new ArrayCache();
        }

        if (empty($storageDriver)) {
            $storageDriver = new FileStorage(__DIR__);
        }

        $driverManager = new DriverManager($config, new Curl());

        $chienit_botmessenger = new BotMessenger($cache, DriverManager::loadFromName('Null', $config), $config, $storageDriver);
        $chienit_botmessenger->runsOnSocket(true);

        $socket->on('connection', function ($conn) use ($chienit_botmessenger, $driverManager) {
            $conn->on('data', function ($data) use ($chienit_botmessenger, $driverManager) {
                $requestData = json_decode($data, true);
                $request = new Request($requestData['query'], $requestData['request'], $requestData['attributes'], [], [], [], $requestData['content']);
                $driver = $driverManager->getMatchingDriver($request);
                $chienit_botmessenger->setDriver($driver);
                $chienit_botmessenger->listen();
            });
        });
        $socket->listen($port);

        return $chienit_botmessenger;
    }

    /**
     * Pass an incoming HTTP request to the socket.
     *
     * @param  int      $port    The port to use. Default is 8080
     * @param  Request|null $request
     * @return void
     */
    public static function passRequestToSocket($port = 8080, Request $request = null)
    {
        if (empty($request)) {
            $request = Request::createFromGlobals();
        }

        $client = stream_socket_client('tcp://127.0.0.1:'.$port);
        fwrite($client, json_encode([
            'attributes' => $request->attributes->all(),
            'query' => $request->query->all(),
            'request' => $request->request->all(),
            'content' => $request->getContent(),
        ]));
        fclose($client);
    }
}
