<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->timestamp('reserved_at')->nullable(); // Ujistěte se, že `reserved_at` je nastaveno jako timestamp
    });
}

public function down()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn('reserved_at');
    });
}
};
