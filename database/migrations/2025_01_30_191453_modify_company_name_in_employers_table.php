<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('company_name')->nullable()->change();
        });
    }

    public function down() {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('company_name')->nullable(false)->change();
        });
    }
};
