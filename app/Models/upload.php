<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class upload extends Model
{
    use HasFactory;

    static public function saveFile( $data ) {
        return DB::table('upload')->insert( $data );
    }
}
