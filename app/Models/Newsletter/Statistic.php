<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    /**
     * @var string
     */
    protected $table = 'newsletter_statistics';

    /**
     * @var array
     */
    protected $fillable = ['template'];

    /**
     * @var array
     */
    protected $casts = [
        'total_emails' => 'int',
        'total_sent' => 'int',
        'total_read' => 'int',
        'total_web_read' => 'int',
        'total_unsubscribed' => 'int',
    ];
}
