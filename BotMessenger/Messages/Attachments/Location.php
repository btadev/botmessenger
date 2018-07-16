<?php

/*
 * This file is part of ChienIt Bot Messenger.
 *
 * (c) Nguyen Duc Chien <chiendevit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace ChienIT\BotMessenger\Messages\Attachments;

class Location extends Attachment
{
    /**
     * Pattern that messages use to identify location attachment.
     */
    const PATTERN = '%%%_LOCATION_%%%';

    /** @var string */
    protected $latitude;

    /** @var string */
    protected $longitude;

    /**
     * Message constructor.
     * @param string $latitude
     * @param string $longitude
     * @param mixed $payload
     */
    public function __construct($latitude, $longitude, $payload = null)
    {
        parent::__construct($payload);
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param string $latitude
     * @param string $longitude
     * @return Location
     */
    public static function create($latitude, $longitude)
    {
        return new self($latitude, $longitude);
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver()
    {
        return [
            'type' => 'location',
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
