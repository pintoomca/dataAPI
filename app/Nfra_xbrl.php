<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nfra_xbrl extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nfra_xbrl';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
     protected $primaryKey = 'cin';
}
