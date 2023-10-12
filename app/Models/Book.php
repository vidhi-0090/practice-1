<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    // Define a constant variable
    public const MORE_THAN_100_PAGES = 1;
    public const LESS_THAN_90_AND_MORE_THAN_25_PAGES = 2;
    public const LESS_THAN_90_AND_MORE_THAN_25_BUT_NOT_80_PAGES = 3;
    public const EMPTY_PAGES_BOOK = 4;
    public const SHOW_ALL_DATA = 5;
    public const RELEASED_YEAR_2015_AND_2001 = 6;
    public const SORT_BY_CATEGORY = 7;
    public const SORT_BY_RELEASED_YEAR= 8;
    public const SORT_BY_BOOK_AUTHOR = 9;
    public const SORT_BY_BOOK_PRICE = 10;
}
