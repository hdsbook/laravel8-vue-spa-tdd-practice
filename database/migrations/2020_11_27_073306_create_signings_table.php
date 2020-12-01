<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSigningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id');
            $table->tinyInteger('progress', false, true)->default(1)->comment('簽核進度(到第幾關)');

            $table->foreignIdFor(User::class, 'create_user_id')->nullable()->default(null);
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
        Schema::dropIfExists('signings');
    }
}
