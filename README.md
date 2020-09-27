# Energenie Mi|Home API

A PHP library to interfacing with the [Enegenie Mi|Home API](https://mihome4u.co.uk/docs/api-documentation) for [Energenie](https://energenie4u.co.uk) smart home devices.

Note: This is not for Xiaomi devices, which are called a similar name.

Currently it supports very few actions. You can list subdevices and turn them on or off.

## Usage

### Installation

    composer require antriver/energenie-mihome-api

### Example Use

```
<?php

use Antriver\EnergenieMihomeApi\Entities\Subdevice;

require __DIR__.'/vendor/autoload.php';

$api = new \Antriver\EnergenieMihomeApi\MihomeApi('email', 'password');

$subdevices = $api->listAllSubdevices();

print_r($subdevices);

$fairyLights = array_values(
    array_filter(
        $subdevices,
        function (Subdevice $subdevice) {
            return $subdevice->label === 'Fairy Lights';
        }
    )
)[0];

$api->powerOnSubdevice($fairyLights->id);

sleep(5);

$api->powerOffSubdevice($fairyLights->id);
```
