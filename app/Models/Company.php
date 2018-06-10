<?php

namespace App\Models;

use App\Models\Company\Type;
use App\Models\Traits\HasAttachments;
use App\ValueObjects\PhoneNumber;
use Collective\Html\Eloquent\FormAccessible;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use KodiCMS\Assets\Contracts\SocialMediaTagsInterface;
use Ramsey\Uuid\Uuid;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Company extends Authenticatable implements SocialMediaTagsInterface
{
    use Notifiable,
        HasStatuses,
        Translatable,
        HasAttachments,
        FormAccessible,
        SoftDeletes;

    /**
     * @var string
     */
    protected $disk = 'public';

    /**
     * @var null
     */
    protected $old_logo = null;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::registerModelEvent('forceDeleted', function (Company $model) {
            Storage::disk($model->disk)->delete($model->logo);
        });

        static::saved(function (Company $model) {
            if (!empty($model->old_logo)) {
                Storage::disk($model->disk)->delete($model->old_logo);
            }
        });
    }

    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'description', 'text', 'contacts'];

    /**
     * @var array
     */
    protected $fillable = [
        'logo', 'email', 'phone', 'login', 'password', 'type_id', 'receive_newsletters'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'verified' => 'bool',
        'receive_newsletters' => 'bool'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $with = ['translations', 'type'];

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        return Company\Translation::class;
    }

    /**
     * @return bool
     */
    public function hasLogo(): bool
    {
        return !empty($this->logo);
    }

    /**
     * @param UploadedFile $file
     * @throws \Exception
     */
    public function setLogoAttribute(UploadedFile $file)
    {
        $this->uploadImage($file);
    }

    /**
     * @return string
     */
    public function getLogoUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->logo);
    }

    /**
     * @param UploadedFile $file
     *
     * @throws \Exception
     */
    public function uploadImage(UploadedFile $file = null)
    {
        if (!$file) {
            return;
        }

        $this->old_logo = $this->logo;
        $this->attributes['logo'] = $file->storeAs(
            'company/logo',
            Uuid::uuid4() . '.' . $file->getClientOriginalExtension(),
            ['disk' => $this->disk]
        );
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeVerified(Builder $builder)
    {
        return $builder->where('verified', true);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return string
     */
    public function getPhoneFormattedAttribute(): string
    {
        if (empty($this->phone)) {
            return null;
        }

        return (new PhoneNumber($this->phone))->prettyFormatted();
    }

    /**
     * @return string
     */
    public function getDescriptionWithBrakesAttribute(): ?string
    {
        return $this->description ? nl2br($this->description) : null;
    }

    /**
     * @return string
     */
    public function getThumbUrlAttribute(): string
    {
        return route('imagecache', ['template' => 'thumb', 'filename' => $this->logo]);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeSubscribers(Builder $builder)
    {
        return $builder->where('receive_newsletters', true);
    }


    ///////////////////////////////////////
    ////////// Social Meta Tags ///////////
    ///////////////////////////////////////

    /**
     * @return string
     */
    public function getOgTitle()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOgDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getOgImage()
    {
        return $this->logo_url;
    }

    /**
     * @return string
     */
    public function getOgUrl()
    {
        return route('company.show', $this->getKey());
    }

    /**
     * @return string
     */
    public function getOgType()
    {
        return 'website';
    }

    /**
     * @return string
     */
    public function getOgPublishedTime()
    {
        return $this->created_at->toIso8601String();
    }

    /**
     * @return string
     */
    public function getOgModifiedTime()
    {
        return $this->updated_at->toIso8601String();
    }

    /**
     * @return string
     */
    public function getOgTags()
    {
        return null;
    }
}
