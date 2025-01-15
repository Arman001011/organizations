<?php

use App\Models\Organization;
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
        if (!Schema::hasTable('organizations')) {
            Schema::create('organizations', function (Blueprint $table) {
                $table->id();
                $table->string('name')->index();
                $table->text('phone_numbers');
                $table->unsignedBigInteger('building_id')->nullable();
                $table->tinyInteger('status')->default(Organization::STATUS_ACTIVE)->index();
                $table->timestamps();

                $table->foreign('building_id')
                    ->references('id')
                    ->on('buildings')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            });
        }

        if (!Schema::hasTable('organization_activity')) {
            Schema::create('organization_activity', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id');
                $table->unsignedBigInteger('activity_id');
                $table->primary(['organization_id','activity_id']);
                $table->timestamps();

                $table->foreign('organization_id')
                    ->references('id')
                    ->on('organizations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

                $table->foreign('activity_id')
                    ->references('id')
                    ->on('activities')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_activity');
        Schema::dropIfExists('organizations');
    }
};
