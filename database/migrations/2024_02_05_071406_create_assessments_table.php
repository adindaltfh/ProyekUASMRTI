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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_evaluasi');
            $table->bigInteger('user_id');
            $table->bigInteger('risk_id');
            $table->tinyInteger('severity');
            $table->tinyInteger('occurrence');
            $table->tinyInteger('detection');
            $table->integer('rpn');
            $table->enum('level', ['Very Low', 'Low', 'Medium', 'High', 'Very High']);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign key constraints
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('risk_id')
                  ->references('id')
                  ->on('risks')
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
        Schema::dropIfExists('assessments');
    }
};