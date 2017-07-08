<?php

namespace ChienIT\BotMessenger\Interfaces;

use ChienIT\BotMessenger\Interfaces\Middleware\Heard;
use ChienIT\BotMessenger\Interfaces\Middleware\Sending;
use ChienIT\BotMessenger\Interfaces\Middleware\Captured;
use ChienIT\BotMessenger\Interfaces\Middleware\Matching;
use ChienIT\BotMessenger\Interfaces\Middleware\Received;

interface MiddlewareInterface extends Captured, Received, Matching, Heard, Sending
{
    //
{
