<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class media_lookup_value extends Model
{
    use Eloquence;
    protected $searchableColumns = ['media_lookup_value_tag'];
    protected $fillable = ['media_lookup_value_tag','media_lookup_value_type', 'media_lookup_value_link', 'archived', 'created_by', 'updated_by'];

    protected $table = "media_lookup_value";
    protected $primaryKey = 'media_lookup_value_id';

}
