<?php

use Illuminate\Database\Seeder;

class AttributeFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_fields')->delete();
        
        \DB::table('attribute_fields')->insert(array (
            0 => 
            array (
                'code' => 'rut',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'RUT',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            1 => 
            array (
                'code' => 'address_algolia',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'ADDRESS_ALGOLIA',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            2 => 
            array (
                'code' => 'address_google',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'ADDRESS_GOOGLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            3 => 
            array (
                'code' => 'address',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'ADDRESS',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            4 => 
            array (
                'code' => 'base64_image',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'BASE64_IMAGE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            5 => 
            array (
                'code' => 'boolean',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'BOOLEAN',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            6 => 
            array (
                'code' => 'browse_multiple',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'BROWSE_MULTIPLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            7 => 
            array (
                'code' => 'browse',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'BROWSE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            8 => 
            array (
                'code' => 'checkbox',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 9,
                'name' => 'CHECKBOX',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            9 => 
            array (
                'code' => 'checklist_dependency',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 10,
                'name' => 'CHECKLIST_DEPENDENCY',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            10 => 
            array (
                'code' => 'checklist',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 11,
                'name' => 'CHECKLIST',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            11 => 
            array (
                'code' => 'ckeditor',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 12,
                'name' => 'CKEDITOR',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            12 => 
            array (
                'code' => 'color_picker',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 13,
                'name' => 'COLOR_PICKER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            13 => 
            array (
                'code' => 'color',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 14,
                'name' => 'COLOR',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            14 => 
            array (
                'code' => 'custom_html',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 15,
                'name' => 'CUSTOM_HTML',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            15 => 
            array (
                'code' => 'date_picker',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 16,
                'name' => 'DATE_PICKER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            16 => 
            array (
                'code' => 'date_range',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 17,
                'name' => 'DATE_RANGE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            17 => 
            array (
                'code' => 'date',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 18,
                'name' => 'DATE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            18 => 
            array (
                'code' => 'datetime_picker',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 19,
                'name' => 'DATETIME_PICKER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            19 => 
            array (
                'code' => 'datetime',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 20,
                'name' => 'DATETIME',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            20 => 
            array (
                'code' => 'easymde',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 21,
                'name' => 'EASYMDE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            21 => 
            array (
                'code' => 'email',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 22,
                'name' => 'EMAIL',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            22 => 
            array (
                'code' => 'enum',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 23,
                'name' => 'ENUM',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            23 => 
            array (
                'code' => 'hidden',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 24,
                'name' => 'HIDDEN',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            24 => 
            array (
                'code' => 'icon_picker',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 25,
                'name' => 'ICON_PICKER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            25 => 
            array (
                'code' => 'image',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 26,
                'name' => 'IMAGE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            26 => 
            array (
                'code' => 'month',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 27,
                'name' => 'MONTH',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            27 => 
            array (
                'code' => 'number',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 28,
                'name' => 'NUMBER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            28 => 
            array (
                'code' => 'page_or_link',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 29,
                'name' => 'PAGE_OR_LINK',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            29 => 
            array (
                'code' => 'password',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 30,
                'name' => 'PASSWORD',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            30 => 
            array (
                'code' => 'radio',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 31,
                'name' => 'RADIO',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            31 => 
            array (
                'code' => 'range',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 32,
                'name' => 'RANGE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            32 => 
            array (
                'code' => 'relationship',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 33,
                'name' => 'RELATIONSHIP',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            33 => 
            array (
                'code' => 'repeatable',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 34,
                'name' => 'REPEATABLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            34 => 
            array (
                'code' => 'select_and_order',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 35,
                'name' => 'SELECT_AND_ORDER',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            35 => 
            array (
                'code' => 'select_from_array',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 36,
                'name' => 'SELECT_FROM_ARRAY',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            36 => 
            array (
                'code' => 'select_grouped',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 37,
                'name' => 'SELECT_GROUPED',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            37 => 
            array (
                'code' => 'select_multiple',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 38,
                'name' => 'SELECT_MULTIPLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            38 => 
            array (
                'code' => 'select',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 39,
                'name' => 'SELECT',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            39 => 
            array (
                'code' => 'select2_from_ajax_multiple',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 40,
                'name' => 'SELECT2_FROM_AJAX_MULTIPLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            40 => 
            array (
                'code' => 'select2_from_ajax',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 41,
                'name' => 'SELECT2_FROM_AJAX',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            41 => 
            array (
                'code' => 'select2_from_array',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 42,
                'name' => 'SELECT2_FROM_ARRAY',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            42 => 
            array (
                'code' => 'select2_grouped',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 43,
                'name' => 'SELECT2_GROUPED',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            43 => 
            array (
                'code' => 'select2_multiple',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 44,
                'name' => 'SELECT2_MULTIPLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            44 => 
            array (
                'code' => 'select2_nested',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 45,
                'name' => 'SELECT2_NESTED',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            45 => 
            array (
                'code' => 'select2',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 46,
                'name' => 'SELECT2',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            46 => 
            array (
                'code' => 'simplemde',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 47,
                'name' => 'SIMPLEMDE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            47 => 
            array (
                'code' => 'summernote',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 48,
                'name' => 'SUMMERNOTE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            48 => 
            array (
                'code' => 'table',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 49,
                'name' => 'TABLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            49 => 
            array (
                'code' => 'text',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 50,
                'name' => 'TEXT',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            50 => 
            array (
                'code' => 'textarea',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 51,
                'name' => 'TEXTAREA',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            51 => 
            array (
                'code' => 'time',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 52,
                'name' => 'TIME',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            52 => 
            array (
                'code' => 'tinymce',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 53,
                'name' => 'TINYMCE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            53 => 
            array (
                'code' => 'upload_multiple',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 54,
                'name' => 'UPLOAD_MULTIPLE',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            54 => 
            array (
                'code' => 'upload',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 55,
                'name' => 'UPLOAD',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            55 => 
            array (
                'code' => 'url',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 56,
                'name' => 'URL',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            56 => 
            array (
                'code' => 'video',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 57,
                'name' => 'VIDEO',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            57 => 
            array (
                'code' => 'view',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 58,
                'name' => 'VIEW',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            58 => 
            array (
                'code' => 'week',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 59,
                'name' => 'WEEK',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
            59 => 
            array (
                'code' => 'wysiwyg',
                'created_at' => '2020-08-22 10:46:38',
                'deleted_at' => NULL,
                'id' => 60,
                'name' => 'WYSIWYG',
                'route' => NULL,
                'status' => 1,
                'updated_at' => '2020-08-22 10:46:38',
            ),
        ));
        
        
    }
}