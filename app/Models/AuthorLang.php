<?php

namespace App\Models;


/**
 * Class AuthorLang
 *
 * @package App\Models\Education
 *
 * @property integer $id
 * @property integer $locale
 * @property integer $owner_id
 * @property string $name
 * @property string $short_body
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class AuthorLang extends MainModel
{
    protected $table = 'authors_lang';
    protected static $unguarded = true;
}
