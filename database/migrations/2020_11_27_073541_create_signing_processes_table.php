<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigningProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signing_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signing_id')->comment('所屬簽核');
            $table->foreignIdFor(User::class, 'sign_user_id')->nullable()->default(null)->comment('簽核者id');
            $table->integer('sequence')->comment('第幾關');

            $table->dateTimeTz('sign_time')->nullable()->default(null)->comment('簽核時間');
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signing_processes');
    }
}
