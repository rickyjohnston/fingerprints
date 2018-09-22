<?php

namespace RickyJohnston\Fingerprints;

use App\User;
use Illuminate\Database\Eloquent\Model;
use RickyJohnston\Fingerprints\Events\ModelCreated;
use RickyJohnston\Fingerprints\Events\ModelUpdated;

abstract class TrackableModel extends Model
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
        'updated' => ModelUpdated::class,
    ];

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updater()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
