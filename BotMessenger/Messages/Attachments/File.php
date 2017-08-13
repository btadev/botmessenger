<?php

namespace ChienIT\BotMessenger\Messages\Attachments;

class File extends Attachment
{
    /**
     * Pattern that messages use to identify file uploads.
     */
    abstract public function buildPayload(Request $request);
