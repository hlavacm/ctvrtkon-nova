<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create("attachments", function (Blueprint $table) {
            $table->id();
            $table->string("name", 150);
            $table->string("file", 255)->unique();
            $table->unsignedSmallInteger("size");
            $table->string("description", 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("attachments");
    }
};
