<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsokiUserTable extends Migration
{
    public function up()
    {
        Schema::create('csoki_user', function (Blueprint $table) {
            $table->id(); // Optional: primary key for the pivot table
            $table->foreignId('csoki_id')->constrained('csokik')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Optional: created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('csoki_user');
    }
}