<?php

namespace RickyJohnston\Fingerprints\Traits;

trait Forensics
{
    /**
     * The owning model has a creator
     */
    public function creator()
    {
        return $this->hasOne(config('fingerprints.model'), 'id', 'created_by');
    }

    /**
     * The owning model has an updater
     */
    public function updater()
    {
        return $this->hasOne(config('fingerprints.model'), 'id', 'updated_by');
    }
}
