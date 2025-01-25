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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();

            $table->string("mission__name");
            $table->string("mission__launch_details__launch_date");
            $table->string("mission__launch_details__launch_site__name");
            $table->string("mission__launch_details__launch_site__location__latitude");
            $table->string("mission__launch_details__launch_site__location__longitude");
            $table->string("mission__landing_details__landing_date");
            $table->string("mission__landing_details__landing_site__name");
            $table->string("mission__landing_details__landing_site__coordinates__latitude");
            $table->string("mission__landing_details__landing_site__coordinates__longitude");
            $table->string("mission__spacecraft__command_module");
            $table->string("mission__spacecraft__lunar_module");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
