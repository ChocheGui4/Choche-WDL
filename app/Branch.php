<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    protected $fillable = [
        'branchname','branchimg','branchtelephone1','branchtelephone2','branchemail1',
        'branchtelephone2','zipcode','district','street', 'insidenumber',
        'exteriornumber','branchstatus'
    ];
}
