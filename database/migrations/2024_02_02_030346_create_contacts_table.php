<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('contacts_business_id_foreign');
            $table->string('type')->index();
            $table->string('contact_type')->nullable();
            $table->string('supplier_business_name')->nullable();
            $table->string('name')->nullable();
            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_id')->nullable();
            $table->string('contact_status')->default('active')->index();
            $table->string('tax_number')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('address_line_1')->nullable();
            $table->text('address_line_2')->nullable();
            $table->string('zip_code')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile');
            $table->string('landline')->nullable();
            $table->string('alternate_number')->nullable();
            $table->integer('pay_term_number')->nullable();
            $table->enum('pay_term_type', ['days', 'months'])->nullable();
            $table->decimal('credit_limit', 22, 4)->nullable();
            $table->unsignedInteger('created_by')->index('contacts_created_by_foreign');
            $table->decimal('balance', 22, 4)->default(0);
            $table->integer('total_rp')->default(0)->comment('rp is the short form of reward points');
            $table->integer('total_rp_used')->default(0)->comment('rp is the short form of reward points');
            $table->integer('total_rp_expired')->default(0)->comment('rp is the short form of reward points');
            $table->boolean('is_default')->default(false);
            $table->text('shipping_address')->nullable();
            $table->longText('shipping_custom_field_details')->nullable();
            $table->boolean('is_export')->default(false);
            $table->string('export_custom_field_1')->nullable();
            $table->string('export_custom_field_2')->nullable();
            $table->string('export_custom_field_3')->nullable();
            $table->string('export_custom_field_4')->nullable();
            $table->string('export_custom_field_5')->nullable();
            $table->string('export_custom_field_6')->nullable();
            $table->string('position')->nullable();
            $table->integer('customer_group_id')->nullable();
            $table->string('custom_field1')->nullable();
            $table->string('custom_field2')->nullable();
            $table->string('custom_field3')->nullable();
            $table->string('custom_field4')->nullable();
            $table->string('custom_field5')->nullable();
            $table->string('custom_field6')->nullable();
            $table->string('custom_field7')->nullable();
            $table->string('custom_field8')->nullable();
            $table->string('custom_field9')->nullable();
            $table->string('custom_field10')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
