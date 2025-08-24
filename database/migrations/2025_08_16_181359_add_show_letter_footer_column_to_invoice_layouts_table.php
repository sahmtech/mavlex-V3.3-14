<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoice_layouts', function (Blueprint $table) {
            $table->boolean('show_letter_footer')->default(false);
        });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_layouts', function (Blueprint $table) {
            //
        });
    }
};