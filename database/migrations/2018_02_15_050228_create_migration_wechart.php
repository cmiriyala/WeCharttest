<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMigrationWechart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //////////////////////////////////////////MEDIA LOOKUP
        Schema::create('media_lookup_value', function (Blueprint $table){
            $table->increments('media_lookup_value_id');
            $table->string('media_lookup_value_tag');
            $table->string('media_lookup_value_type');
            $table->string('media_lookup_value_link');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });         
    ///////////////////////////////////////////PROCEDURE LOOKUP
        Schema::create('procedure_orders_lookup_value', function (Blueprint $table){
            $table->increments('procedure_orders_lookup_value_id');
            $table->string('procedure_orders_lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    //////////////////////////////////////////////IMAGING ORDERS LOOKUP
        Schema::create('imaging_orders_lookup_value', function (Blueprint $table) {
            $table->increments('imaging_orders_lookup_value_id');
            $table->string('imaging_orders_lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ////////////////////////////////////////////////LAB ORDERS LOOKUP
        Schema::create('lab_orders_lookup_value', function (Blueprint $table) {
            $table->increments('lab_orders_lookup_value_id');
            $table->string('lab_orders_lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ///////////////////////////////////////////////DIAGNOSIS LOOKUP
        Schema::create('diagnosis_lookup_value', function (Blueprint $table) {
            $table->increments('diagnosis_lookup_value_id');
            $table->string('diagnosis_lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    //////////////////////////////////////////////MED LOOKUP
        Schema::create('med_lookup_value', function (Blueprint $table) {
            $table->increments('med_lookup_value_id');
            $table->string('med_lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
//            $table->rememberToken();
            $table->timestamps();
        });
    ///////////////////////////////////////////////LOOKUP VALUE
        Schema::create('lookup_value', function (Blueprint $table) {
            $table->increments('lookup_value_id');
            $table->string('lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
//            $table->rememberToken();
            $table->timestamps();
        });
    /////////////////////////////////////////////////DOC CONTROL TYPE
        Schema::create('doc_control_type', function (Blueprint $table) {
            $table->increments('doc_control_type_id');
            $table->string('control_type');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ///////////////////////////////////////////////FREE TEXT VALUE TYPE
        Schema::create('freetext_value_type', function (Blueprint $table) {
            $table->increments('freetext_value_type_id');
            $table->string('freetext_value_type');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ////////////////////////////////////////////////NAVIGATIONS
        Schema::create('navigations', function (Blueprint $table) {
            $table->increments('navigation_id');
            $table->string('navigation_name');
            $table->integer('parent_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    /////////////////////////////////////////////////MODULE
        Schema::create('module', function (Blueprint $table) {
            $table->increments('module_id');
            $table->string('module_name')->unique;
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });
    /////////////////////////////////////////////////PATIENT RECORD STATUS
        Schema::create('patient_record_status', function (Blueprint $table) {
            $table->increments('patient_record_status_id');
            $table->string('patient_record_status');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    /////////////////////////////////////////////////SECURITY QUESTION
        Schema::create('security_question', function (Blueprint $table) {
            $table->increments('security_question_id');
            $table->string('security_question')->unique();
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });
    ////////////////////////////////////////////////DEPARTMENT
        Schema::create('department', function (Blueprint $table) {
            $table->increments('department_id');
            $table->string('department_name');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ////////////////////////////////////////////////USERS
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('password',60);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('contactno')->nullable();
            $table->string('role');
            $table->integer('department_id')->nullable();
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    /////////////////////////////////////////////////EMAIL ID ROLE
        Schema::create('EmailIdRole', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique(); 
            $table->string('role');
            $table->timestamps();
        });
    ////////////////////////////////////////////////SECURITY QUESTION USERS
        Schema::create('security_question_users', function (Blueprint $table) {
            $table->increments('security_question_user_id');
            $table->integer('security_question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('security_question_answer');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ////////////////////////////////////////////////PATIENT
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('patient_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->integer('age');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('room_number')->default(0);
            $table->string('visit_date');
            $table->string('submitted_date')->nullable();
            $table->boolean('completed_flag')->default(0);
            $table->integer('module_id')->unsigned();
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    ////////////////////////////////////////////USERS PATIENT
        Schema::create('users_patient', function (Blueprint $table) {
            $table->increments('users_patient_id')->unsigned();
            $table->integer('patient_record_status_id')->unsigned();
            $table->integer('patient_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('feedback')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();

          //  $table->primary(['patient_id', 'user_id']);
            $table->rememberToken();
            $table->timestamps();
        });
    ////////////////////////////////////////////MODULES NAVIGATION
        Schema::create('modules_navigations', function (Blueprint $table) {
            $table->integer('navigation_id');
            $table->integer('module_id');
            $table->boolean('visible');
            $table->integer('display_order');
          //  $table->primary(['module_id', 'navigation_id']);
            $table->timestamps();
        });
    ////////////////////////////////////////////DOC CONTROL
        Schema::create('doc_control', function (Blueprint $table) {
            $table->increments('doc_control_id');
            $table->integer('navigation_id')->unsigned();
            $table->string('label');
            $table->integer('doc_control_type_id')->unsigned();
            $table->integer('freetext_value_type_id')->unsigned()->nullable();
            $table->integer('doc_control_group')->nullable();
            $table->integer('doc_control_group_order')->nullable();
            $table->string('lookup_table_used')->nullable();
            $table->integer('freetext_minval_number')->nullable();
            $table->integer('freetext_maxval_number')->nullable();
            $table->date('freetext_minval_date')->nullable();
            $table->date('freetext_maxval_date')->nullable();
            $table->integer('freetext_minval_length')->nullable();
            $table->integer('freetext_maxval_length')->nullable();
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
//            $table->rememberToken();
            $table->timestamps();
        });
    ////////////////////////////////////////////////////DOC LOOKUP VALUE
        Schema::create('doc_lookup_value', function (Blueprint $table) {
            $table->integer('doc_control_id')->unsigned();
            $table->integer('lookup_value_id')->unsigned();
            $table->integer('sort_order_number')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ///////////////////////////////////////////////////ACTIVE RECORD
        Schema::create('active_record', function (Blueprint $table) {
            $table->increments('active_record_id');
            $table->integer('patient_id')->unsigned();
            $table->integer('navigation_id')->unsigned();
            $table->integer('doc_control_id')->unsigned();
            $table->integer('doc_control_group')->nullable();
            $table->integer('doc_control_group_order')->nullable();
            $table->string('value',16000)->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    ////////////////////////////////////////////////////CSV DATA
        Schema::create('csv_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medical_list');
            $table->timestamps();
        });
        //Navigations table self keys
        Schema::table('navigations', function (Blueprint $table) {
            $table->foreign('parent_id')->references('navigation_id')->on('navigations');
        });
        //Adding foreign key constraint with EmailidRole table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('EmailIdRole');
        });

        //Adding foreign key constraints with Department table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('department_id')->references('department_id')->on('department');
        });
        //Security Question users table self keys
        Schema::table('security_question_users', function (Blueprint $table) {
            $table->foreign('security_question_id')->references('security_question_id')->on('security_question');
        });
        //Security Question users table with users table
        Schema::table('security_question_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        //Adding foreign key constraint with module table
        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('module_id')->references('module_id')->on('module');
        });
        //Adding foreign key constraint with patient_record_status table
        Schema::table('users_patient', function (Blueprint $table) {
            $table->foreign('patient_record_status_id')->references('patient_record_status_id')->on('patient_record_status');
        });
        //Adding foreign key constraint with patient table
        Schema::table('users_patient', function (Blueprint $table) {
            $table->foreign('patient_id')->references('patient_id')->on('patient');
        });
        //This will be changed once the new data model is in place.
        //Adding foreign key constraint with users table
        Schema::table('users_patient', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        //Adding foreign key constraint with module table
        Schema::table('modules_navigations', function (Blueprint $table) {
            $table->foreign('module_id')->references('module_id')->on('module');
        });
        //Adding foreign key constraint with navigations table
        Schema::table('modules_navigations', function (Blueprint $table) {
            $table->foreign('navigation_id')->references('navigation_id')->on('navigations');
        });
        //Adding foreign key constraint with navigation table
        Schema::table('doc_control', function (Blueprint $table) {
            $table->foreign('navigation_id')->references('navigation_id')->on('navigations');
        });
        //Adding foreign key constraint with doc_control_type table
        Schema::table('doc_control', function (Blueprint $table) {
            $table->foreign('doc_control_type_id')->references('doc_control_type_id')->on('doc_control_type');
        });
        //Adding foreign key constraint with freetext_value_type table
        Schema::table('doc_control', function (Blueprint $table) {
            $table->foreign('freetext_value_type_id')->references('freetext_value_type_id')->on('freetext_value_type');
        });
        //Doc lookup value with Doc control
        Schema::table('doc_lookup_value', function (Blueprint $table) {
            $table->foreign('doc_control_id')->references('doc_control_id')->on('doc_control');
        });
        //Doc lookup value with Lookup value
        Schema::table('doc_lookup_value', function (Blueprint $table) {
            $table->foreign('lookup_value_id')->references('lookup_value_id')->on('lookup_value');
        });
        //Adding foreign key constraint with Navigation table
        Schema::table('active_record', function (Blueprint $table) {
            $table->foreign('navigation_id')->references('navigation_id')->on('navigations');
        });
        //Adding foreign key constraint with Patient table
        Schema::table('active_record', function (Blueprint $table) {
            $table->foreign('patient_id')->references('patient_id')->on('patient');
        });
        //Adding foreign key constraint with Doc Control table
        Schema::table('active_record', function (Blueprint $table) {
            $table->foreign('doc_control_id')->references('doc_control_id')->on('doc_control');
        });
    }

    public function down()
    {
        //Drop Schema is reordered based upon the Primary and Foreign Key dependencies

        //////////////////////////////////////////////MEDIA LOOKUP
        Schema::dropIfExists('media_lookup_value');
        //////////////////////////////////////////////PROCEDURES ORDER LOOKUP
        Schema::dropIfExists('procedure_orders_lookup_value');
        ///////////////////////////////////////////////IMAGING ORDERS LOOKUP
        Schema::dropIfExists('imaging_orders_lookup_value');
        ///////////////////////////////////////////////LAB ORDERS LOOKUP
        Schema::dropIfExists('lab_orders_lookup_value');
        ////////////////////////////////////////////////DIAGNOSIS LOOKUP
        Schema::dropIfExists('diagnosis_lookup_value');
        /////////////////////////////////////////////////MED LOOKUP
        Schema::dropIfExists('med_lookup_value');
        ////////////////////////////////////////////SECURITY QUESTION USER
        Schema::dropIfExists('security_question_users');
        ///////////////////////////////////////////////SECURITY QUESTION
        Schema::dropIfExists('security_question');
        ////////////////////////////////////////////USERS PATIENT
        Schema::dropIfExists('users_patient');
        ///////////////////////////////////////////////PATIENT RECORD STATUS
        Schema::dropIfExists('patient_record_status');
        /////////////////////////////////////////////USERS
        Schema::dropIfExists('users');
        ///////////////////////////////////////////////DEPARTMENT
        Schema::dropIfExists('department');
        ////////////////////////////////////////////EMAIL ID ROLE
        Schema::dropIfExists('EmailIdRole');
        ////////////////////////////////////////////DOC LOOKUP VALUE
        Schema::dropIfExists('doc_lookup_value');
        ////////////////////////////////////////////////LOOKUP VALUE
        Schema::dropIfExists('lookup_value');
        ///////////////////////////////////////////ACTIVE RECORD
        Schema::dropIfExists('active_record');
        ////////////////////////////////////////////PATIENT
        Schema::dropIfExists('patient');
        ////////////////////////////////////////////MODULES NAVIGATION
        Schema::dropIfExists('modules_navigations');
        ///////////////////////////////////////////////MODULE
        Schema::dropIfExists('module');
        ////////////////////////////////////////////DOC CONTROL
        Schema::dropIfExists('doc_control');    
        ////////////////////////////////////////////////DOC CONTROL TYPE
        Schema::dropIfExists('doc_control_type');  
        ///////////////////////////////////////////////FREE TEXT VALUE TYPE
        Schema::dropIfExists('freetext_value_type'); 
        ///////////////////////////////////////////////NAVIGATIONS
        Schema::dropIfExists('navigations');
        ////////////////////////////////////////////CSV DATA
        Schema::dropIfExists('csv_data');
    }
}
