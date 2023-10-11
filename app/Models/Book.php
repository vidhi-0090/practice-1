<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    // Define a constant variable
    public const More_Than_100_Pages = 1;
    public const Less_Than_90_And_More_Than_25_Pages = 2;
    public const Less_Than_90_And_More_Than_25_But_Not_80_Pages = 3;
    public const Not_Pages_Books = 4;
    public const Show_All_Data = 5;
    public const Released_Year_2015_And_2001 = 6;
}
