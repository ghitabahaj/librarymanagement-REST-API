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
        Schema::create('genrees_livre', function (Blueprint $table) {
        $table->id();
        $table->unsignedBiginteger('livre_id')->unsigned();
        $table->unsignedBiginteger('genre_id')->unsigned();
        
        $table->foreign('livre_id')->references('id')
             ->on('livres')->onDelete('cascade');
        $table->foreign('genre_id')->references('id')
            ->on('genres')->onDelete('cascade');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('genrees_livre');
    }
};
