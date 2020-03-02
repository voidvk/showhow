<?php

namespace App\Models;

use App\Admin\Traits\UploaderTrait;
use App\Models\Education\ECourseAuthor;
use Cviebrock\EloquentSluggable\Sluggable;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Auth;
use Waavi\Translation\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\UpdatedBy;

/**
 * @property int             $id
 * @property string          $locale
 * @property string          $slug
 * @property string          $visible_locale
 * @property string          $name
 * @property string          $img
 * @property string          $short_body
 * @property string          $body
 * @property int             $partner_id
 * @property int             $created_at
 * @property int             $updated_at
 * @property ECourseAuthor[] $coursesAuthors
 * @property Partner         $partner
 */
class Author extends MainModel
{
    use Translatable;
    use UploaderTrait;
    use Sluggable;
	use Blameable, CreatedBy, UpdatedBy;

    public $translationModel      = AuthorLang::class;
    public $translationForeignKey = 'owner_id';
    public $saveUploadPath   = 'author/[[id]]';

    public $uploadAttributes = [
        'img' => [
            'prefix' => 'img_'
        ],
    ];

    public $translatedAttributes  = [
		'name',
		'short_body',
		'body',
    ];

    const AUTORS_COUNT = 33;
    /**
     * @var array
     */
    protected $fillable = [
        'locale',
        'visible_locale',
        'name',
        'img',
        'short_body',
        'body',
        'partner_id',
        'translate',//Это надо для переводов
        'slug'
    ];

	protected $blameable = array('created', 'updated');

    const PAGINATE_AUTHOR_LENGTH = 9;
    const LOAD_PAGINATE_LENGTH = 6;

//    public static function boot()
//    {
//        static::created(function($item) {
//            AuditLog::write(self::getAuditLogData($item, 'created'));
//        });
//
//        static::updated(function($item) {
//            AuditLog::write(self::getAuditLogData($item, 'updated'));
//        });
//
//        static::deleted(function($item) {
//            AuditLog::write(self::getAuditLogData($item, 'deleted'));
//        });
//
//    }
//
    public static function getAuditLogData($item, $event)
    {
        /* @var $item self */
        return [
            'entity_id' => $item->id,
            'entity_type' => 'Автор',
            'entity_name' => $item->name,
            'changed_at' => date('Y-m-d h:m:s'),
//            'changed_fields' => json_encode($item->getChanges()),
//            'changed_data' => json_encode($item->getChanges()),
            'user_id' => \Auth::user()->id,
            'user_login' => \Auth::user()->email,
            'ip_address' => request()->header('X-Real-IP'),
            'http_method' => request()->method(),
            'event' => $event,
            'browser_type' => request()->userAgent(),
        ];
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @param \Cocur\Slugify\Slugify $engine
     * @param string $attribute
     * @return \Cocur\Slugify\Slugify
     */
    public function customizeSlugEngine(Slugify $engine, $attribute)
    {
        $engine->addRule('ә', 'а');
        $engine->addRule('Ә', 'a');
        $engine->addRule('ғ', 'g');
        $engine->addRule('Ғ', 'g');
        $engine->addRule('қ', 'q');
        $engine->addRule('Қ', 'k');
        $engine->addRule('ө', 'o');
        $engine->addRule('Ө', 'o');
        $engine->addRule('ұ', 'u');
        $engine->addRule('Ұ', 'u');
        $engine->addRule('ү', 'u');
        $engine->addRule('Ү', 'u');
        $engine->addRule('һ', '');
        $engine->addRule('Һ', '');
        $engine->addRule('і', 'i');
        $engine->addRule('І', 'i');
        $engine->addRule('ң', 'ng');
        $engine->addRule('Ң', 'ng');

        return $engine;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisibleLocale($query) {

        if (\App::getLocale() === 'kz') {
            return $query->whereIn('visible_locale', ['only_' . \App::getLocale(), 'all', 'not_ru']);
        } else {
            return $query->whereIn('visible_locale', ['only_' . \App::getLocale(), 'all', 'not_kz']);
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coursesAuthors()
    {
        return $this->hasMany(ECourseAuthor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'education_courses_authors', 'author_id', 'course_id')->where('is_published', 1)->where('locale', app()->getLocale());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function course()
    {
        return $this->belongsToMany('App\Models\Course', 'education_courses_authors', 'author_id', 'course_id');
    }

    public function getCreatedUser()
	{
		$created_by = 'NONE';

		if ($this->created_by) {
			$user = User::find($this->created_by);
			$created_by = $user->email . " / " . $user->firstname . " " . $user->surname;
		}

		return $created_by;
	}

	public function getUpdatedUser()
	{
		$updated_by = 'NONE';

		if ($this->updated_by) {
			$user = User::find($this->updated_by);
			$updated_by = $user->email . " / " . $user->firstname . " " . $user->surname;
		}

		return $updated_by;
	}

    public function getLocaleUrl()
    {
        return url_add_lang('author' . '/' . $this->slug, $this->locale);
    }
}
