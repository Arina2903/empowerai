<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    protected $fillable = ['year', 'month', 'sales', 'cost', 'team_size'];

    public function getProfitAttribute()
    {
        return $this->sales - $this->cost;
    }

    public function getMonthLabelAttribute()
    {
        return date("M Y", strtotime("$this->year-$this->month-01"));
    }
}
