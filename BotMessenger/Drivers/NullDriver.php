<?php

namespace ChienIT\BotMessenger\Drivers;

use ChienIT\BotMessenger\Users\User;
use ChienIT\BotMessenger\Messages\Incoming\Answer;
use Symfony\Component\HttpFoundation\Request;
use ChienIT\BotMessenger\Messages\Incoming\IncomingMessage;

class NullDriver extends HttpDriver
{
    /**
     * @param Request $request
     */
    public function buildPayload(Request $request)
    {
    }

    /**
     * Determine if the request is for this driver.
use Illuminate\Support\Facades\Facade;
