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
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('color_id')->after('category_id')->nullable()->index()->constrained('colors')->onDelete('cascade');
            $table->foreign('tag_id')->after('color_id')->nullable()->index()->constrained('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('color_id', 'tag_id');
            $table->dropColumn('color_id', 'tag_id');
        });
    }
};
