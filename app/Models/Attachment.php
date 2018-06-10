<?php

namespace App\Models;

use App\Models\Traits\HasPrivateMaterials;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class Attachment extends Model
{
    use HasPrivateMaterials;

    /**
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $guarded = ['file_path'];

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'is_private'];

    /**
     * @var array
     */
    protected $casts = [
        'is_private' => 'bool'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Attachment $attachment) {
            $attachment->uuid = Uuid::uuid4();
        });

        static::deleted(function (Attachment $attachment) {
            Storage::disk($attachment->disk)->delete($attachment->file_path);
        });
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->file_path);
    }

    /**
     * @return string
     */
    public function getFormattedSizeAttribute(): string
    {
        $base = log($this->size, 1024);
        $suffixes = array('b', 'Kb', 'Mb', 'Gb', 'Tb');

        return round(pow(1024, $base - floor($base)), 0) .' '. $suffixes[floor($base)];
    }

    /**
     * @param UploadedFile $file
     * @param string $section
     * @return $this
     */
    public function upload(UploadedFile $file, string $section)
    {
        $this->disk = Storage::getDefaultDriver();

        $this->title = $this->title ?: $file->getClientOriginalName();
        $this->size = $file->getClientSize();
        $this->mime = $file->getMimeType();
        $this->file_path = $file->storePublicly('attachment/'.$section);

        return $this;
    }

    /**
     * Relationship: model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function section()
    {
        return $this->morphTo();
    }
}
