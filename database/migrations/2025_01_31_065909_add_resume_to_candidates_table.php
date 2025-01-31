<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('resume')->nullable()->after('experience_years'); // تخزين مسار ملف الـ CV
        });
    }

    public function down() {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('resume');
        });
    }
};
