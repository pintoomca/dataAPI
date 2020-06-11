<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditorDetail_xbrl extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auditor_detailsxbrl_2017';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
     protected $primaryKey = 'CIN';
}
