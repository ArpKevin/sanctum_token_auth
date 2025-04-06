<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsokikTable extends Migration
{
    public function up()
    {
        Schema::create('csokik', function (Blueprint $table) {
            $table->id(); // Use tinyIncrements for auto-incrementing primary key
            $table->string('nev', 255); // Name column
            $table->string('ara', 255); // Price column
            $table->boolean('raktaron'); // Stock column
            $table->timestamps(); // Optional: created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('csokik');
    }
}