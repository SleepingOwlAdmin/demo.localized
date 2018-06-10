<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

trait HasImage
{
    /**
     * @var string
     */
    protected $disk = 'public';

    /**
     * @var null
     */
    protected $old_image = null;

    protected static function bootHasImage()
    {
        $class = static::class;

        if (in_array(SoftDeletes::class, class_uses_recursive($class))) {
            static::registerModelEvent('forceDeleted', function (Model $model) {
                Storage::disk($model->disk)->delete($model->image);
            });
        } else {
            static::deleted(function (Model $model) {
                Storage::disk($model->disk)->delete($model->image);
            });
        }

        static::saved(function (Model $model) {
            if (!empty($model->old_image)) {
                \Storage::disk($model->disk)->delete($model->old_image);
            }
        });
    }

    /**
     * @return string
     */
    protected function getImageFolderName(): string
    {
        return strtolower(class_basename(get_called_class()));
    }

    /**
     * @param UploadedFile|null $file
     * @return false|string|void
     */
    public function uploadImage(UploadedFile $file = null)
    {
        if (!$file) {
            return;
        }

        $section = $this->getImageFolderName();

        $this->old_image = $this->image;

        return $file->storeAs(
            $section . '/images',
            Uuid::uuid4() . '.' . $file->getClientOriginalExtension(),
            ['disk' => $this->disk]
        );
    }

    /**
     * @return bool
     */
    public function hasImage(): bool
    {
        return !empty($this->image);
    }

    /**
     * @param UploadedFile|string $file
     * @throws \Exception
     */
    public function setImageAttribute($file)
    {
        if ($file instanceof UploadedFile) {
            $file = $this->uploadImage($file);
        }

        $this->attributes['image'] = $file;
    }

    /**
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->image);
    }

    /**
     * @return string
     */
    public function getThumbUrlAttribute(): string
    {
        return route('imagecache', ['template' => 'thumb', 'filename' => $this->image]);
    }
}