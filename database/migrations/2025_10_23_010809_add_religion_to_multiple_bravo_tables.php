<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $tables = [
            'bravo_bookings',
            'bravo_assistance',
            'bravo_events',
            'bravo_hotels',
            'bravo_locations',
            'bravo_services',
            'bravo_spaces',
            'bravo_tours',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'religion')) {
                    $table->enum('religion', ['CATHOLIC', 'EVANGELICAL', 'BOTH'])
                          ->nullable()
                          ->after('status');
                }
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'bravo_bookings',
            'bravo_assistance',
            'bravo_events',
            'bravo_hotels',
            'bravo_locations',
            'bravo_services',
            'bravo_spaces',
            'bravo_tours',
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('religion');
            });
        }
    }
};
