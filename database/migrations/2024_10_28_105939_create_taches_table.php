<?php

use App\Models\Tache;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('duree');
            $table->date('datedebut');
            $table->enum('status', ['nouveau', 'en cours', 'termine']);
            $table->enum('date', ['jour', 'semaine', 'mois']);
            $table->foreignId('iduser')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    } 

    public function down()
    {
        Schema::dropIfExists('taches');
    }
}
