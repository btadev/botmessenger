<?php

namespace ChienIT\BotMessenger\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface VerifiesService
{
    public function verifyRequest(Request $request);
}