<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStartOnEndOnBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->renameColumn('start_on', 'booking_date_from');
            $table->renameColumn('end_on', 'booking_date_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->renameColumn('booking_date_from', 'start_on');
            $table->renameColumn('booking_date_to', 'end_on');
        });
    }
}
