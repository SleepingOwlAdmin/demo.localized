<?php

namespace App\Models\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;

trait HasAttachments
{
    /**
     * Get the attachments relation morphed to the current model class
     *
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'section');
    }

    /**
     * @param UploadedFile $file
     * @param array $options Set attachment options : title, description, key, disk
     *
     * @return Attachment
     * @throws \Exception
     */
    public function attach(UploadedFile $file, array $options = []): Attachment
    {
        $options = array_only($options, config('attachments.attributes'));

        /** @var Attachment $attachment */
        $attachment = new Attachment($options);

        $attachment->upload($file, strtolower(class_basename($this)));

        return $this->attachments()->save($attachment);
    }
}