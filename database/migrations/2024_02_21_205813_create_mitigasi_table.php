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
        Schema::create('mitigasi_risiko', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('risk_id')->unsigned();
            $table->bigInteger('asset_id')->unsigned();
            $table->date('tanggal');
            $table->string('klausul', 255);
            $table->text('mitigasi_risiko');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign key constraints
            $table->foreign('risk_id')
                  ->references('id')
                  ->on('risks')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitigasi_risiko');
    }
};