<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cia', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_aset_id', ['data', 'software', 'network', 'hardware', 'sumber daya manusia'])->unique();
            $table->tinyInteger('c');
            $table->tinyInteger('i');
            $table->tinyInteger('a');
            $table->tinyInteger('aset_value');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cia');
    }
};