<?php

namespace RickyJohnston\Fingerprints;

use Illuminate\Database\Eloquent\Model;
use RickyJohnston\Fingerprints\Events\ModelCreated;
use RickyJohnston\Fingerprints\Events\ModelUpdated;
use RickyJohnston\Fingerprints\Traits\Forensics;

abstract class TrackableModel extends Model
{
    use Forensics;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
        'updated' => ModelUpdated::class,
    ];
}
