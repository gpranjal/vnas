<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('question');
            $table->text('answer');
            $table->integer('sort');
            $table->text('tags');   // for JSON
            $table->boolean('draft_flag');
            $table->string('faq_role');
            $table->timestamps();
            $table->softDeletes();
        });

        //insert default faqs
        DB::table('faqs')->insert(
            array(

                array(
                    'question' => 'How do I login?',
                    'answer' => 'In the top right, click login.',
                    'sort'=> '7',
                    'tags'=>'["Companion Care"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Patient',
                    'created_at'=> '2016-03-05 10:05:13',
                    'updated_at'=>'2016-03-17 04:46:12',
                    'deleted_at'=> null
                    ),

                array(
                    'question' => 'What services are offered?',
                    'answer' => 'VNA Caregivers provide help with day-to-day living, ranging from light housekeeping and meal preparation, to assistance with activities of daily living and help with medications.',
                    'sort'=> '2',
                    'tags'=>'["Prospect"]',
                    'draft_flag' => '0',
                    'faq_role' => '',
                    'created_at'=> '2016-03-08 10:05:13',
                    'updated_at'=>'2016-03-16 04:46:12',
                    'deleted_at'=> null
                    ),

               array(
                   'question' => 'Can Caregivers provide nursing care?',
                   'answer' => 'As a licensed home healthcare agency, VNA is able to provide skilled medical care in the home in addition to Companion Care services.  Skilled care is often covered paid for under a person’s insurance plan.',
                   'sort'=> '3',
                   'tags'=>'["Caregiver"]',
                   'draft_flag' => '0',
                   'faq_role' => 'Caregiver',
                   'created_at'=> '2016-03-18 10:05:13',
                   'updated_at'=>'2016-03-26 04:46:12',
                   'deleted_at'=> null
               ),

                array(
                    'question' => 'Who are the VNA Companion Care caregivers?',
                    'answer' => 'VNA Companion Care employs well-trained staff to provide all levels of care. All employees are competency tested and receive continual training in specialized areas. All VNA Companion Care staff are thoroughly screened, background checked, drug tested, bonded, and insured.',
                    'sort'=> '4',
                    'tags'=>'["Companion Care"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Patient',
                    'created_at'=> '2016-03-19 10:05:13',
                    'updated_at'=>'2016-03-27 04:46:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'When are VNA Companion Care Services available?',
                    'answer' => 'VNA Companion Care services are available from as few as 3 hours a week to 24 hours a day, 7 days a week, 365 days a year. VNA Companion Care serves the greater Omaha / Council Bluffs metropolitan area.',
                    'sort'=> '5',
                    'tags'=>'["Companion Care"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Patient',
                    'created_at'=> '2016-03-20 10:05:13',
                    'updated_at'=>'2016-03-28 04:46:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'How are Companion Care services paid for?',
                    'answer' => 'VNA Companion Care services are typically Private Pay, however VNA Companion Care does accept payment from long-term care insurance, trust officers, the VA, Medicaid Waiver, Workmen’s Compensation, Respite Grants and other third party payers.',
                    'sort'=> '6',
                    'tags'=>'["Companion Care"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Patient',
                    'created_at'=> '2016-03-21 10:05:13',
                    'updated_at'=>'2016-03-29 04:46:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'VNA Mission, Vision & Values',
                    'answer' => 'Mission: Delivering community based care… Vision:  Improve the life and health…. Values:            Compassion: we believe…            Attitude:…           Respect:…            Excellence:…',
                    'sort'=> '1',
                    'tags'=>'["Caregiver"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Caregiver',
                    'created_at'=> '2016-03-21 11:05:13',
                    'updated_at'=>'2016-03-29 05:46:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'How do I access the VNA Intranet?',
                    'answer' => 'Visit vnamstaff.org and enter your log in information',
                    'sort'=> '8',
                    'tags'=>'["Caregiver"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Caregiver',
                    'created_at'=> '2016-03-21 11:08:13',
                    'updated_at'=>'2016-03-29 05:49:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'How can I find the pay schedule?',
                    'answer' => 'To see the payroll schedule, log on to the VNA Intranet and click on the ‘Finance/Payroll’ tab.',
                    'sort'=> '9',
                    'tags'=>'["Caregiver"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Caregiver',
                    'created_at'=> '2016-03-22 11:08:13',
                    'updated_at'=>'2016-03-30 05:49:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'How do I to access in-service/relias?',
                    'answer' => '1. Go to Browser 2. Open up www.thevnacares.org 3. Scroll to bottom of page. Go to intranet. 4. Enter username "hha" with password "P@ssword2" 5. Scroll to bottom, right had corner and hit Relias learning 6. Open Relias and enter your username and password',
                    'sort'=> '10',
                    'tags'=>'["Caregiver"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Caregiver',
                    'created_at'=> '2016-03-21 10:08:13',
                    'updated_at'=>'2016-03-29 04:49:12',
                    'deleted_at'=> null
                ),

                array(
                    'question' => 'When are the CPR Re-certification dates?',
                    'answer' => 'To find the current schedule for CPR recertification, log on to the VNA Intranet, click on the ‘Quality/Safety’ tab, then scroll down to ‘CPR Class Dates’.',
                    'sort'=> '11',
                    'tags'=>'["Caregiver"]',
                    'draft_flag' => '0',
                    'faq_role' => 'Caregiver',
                    'created_at'=> '2016-03-25 09:08:13',
                    'updated_at'=>'2016-03-30 03:49:12',
                    'deleted_at'=> null
                ),



            )
        );
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }
}
