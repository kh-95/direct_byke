<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use \Illuminate\Support\Facades\DB;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            [
                'name' => 'admins',
                'category' => 'المديرين',
                'display_name' => 'المديرين',
                'guard_name' => 'web',
                'routes' => 'admins.index',

            ],
            [
                'name' => 'add_admin',
                'category' => 'المديرين',
                'display_name' => 'اضافه مدير',
                'guard_name' => 'web',
                'routes' => 'admins.create,admins.store',
            ],
            [
                'name' => 'show_admin',
                'category' => 'المديرين',
                'display_name' => 'عرض  مدير',
                'guard_name' => 'web',
                'routes' => 'admins.show',
            ],
            [
                'name' => 'edit_admin',
                'category' => 'المديرين',
                'display_name' => 'تعديل مدير',
                'guard_name' => 'web',
                'routes' => 'admins.edit,admins.update'
            ],
            [
                'name' => 'delete_admin',
                'category' => 'المديرين',
                'display_name' => 'حذف مدير',
                'guard_name' => 'web',
                'routes' => 'admins.destroy',

            ],
            [
                'name' => 'toggleactive_admin',
                'category' => 'المديرين',
                'display_name' => 'تفعيل_تعطيل مدير',
                'guard_name' => 'web',
                'routes' => 'toggleactive_admin',

            ],


            [
                'name' => 'users',
                'category' => 'المستخدمين',
                'display_name' => 'المستخدمين',
                'guard_name' => 'web',
                'routes' => 'users.index',
            ],
            [
                'name' => 'show_user',
                'category' => 'المستخدمين',
                'display_name' => 'عرض مستخدم',
                'guard_name' => 'web',
                'routes' => 'users.show',

            ],
            [
                'name' => 'toggleactive_user',
                'category' => 'المستخدمين',
                'display_name' => ' تفعيل _ تعطيل مستخدم',
                'guard_name' => 'web',
                'routes' => 'toggleactive_user',
            ],


            [
                'name' => 'roles',
                'category' => 'الصلاحيات',
                'display_name' => 'الصلاحيات',
                'guard_name' => 'web',
                'routes' => 'roles.index'
            ],
            [
                'name' => 'add_role',
                'category' => 'الصلاحيات',
                'display_name' => 'اضافه صلاحيه',
                'guard_name' => 'web',
                'routes' => 'roles.create,roles.store'
            ],
            [
                'name' => 'edit_role',
                'category' => 'الصلاحيات',
                'display_name' => 'تعديل صلاحيه',
                'guard_name' => 'web',
                'routes' => 'roles.edit,roles.update'
            ],
            [
                'name' => 'delete_role',
                'category' => 'الصلاحيات',
                'display_name' => 'حذف صلاحيه',
                'guard_name' => 'web',
                'routes' => 'roles.destroy'
            ],
            [
                'name' => 'toggleactive_role',
                'category' => 'الصلاحيات',
                'display_name' => ' تفعيل _ تعطيل صلاحية',
                'guard_name' => 'web',
                'routes' => 'toggleactive_role',
            ],

            [
                'name' => 'regions',
                'category' => 'المناطق',
                'display_name' => 'المناطق',
                'guard_name' => 'web',
                'routes' => 'regions.index'
            ],
            [
                'name' => 'add_region',
                'category' => 'المناطق',
                'display_name' => 'اضافه منطقة',
                'guard_name' => 'web',
                'routes' => 'regions.create,regions.store'

            ],
            [
                'name' => 'edit_region',
                'category' => 'المناطق',
                'display_name' => 'تعديل منطقة',
                'guard_name' => 'web',
                'routes' => 'regions.edit,regions.update'
            ],
            [
                'name' => 'delete_region',
                'category' => 'المناطق',
                'display_name' => 'حذف منطقة',
                'guard_name' => 'web',
                'routes' => 'regions.destroy'
            ],
            [
                'name' => 'toggleactive_region',
                'category' => 'المناطق',
                'display_name' => ' تفعيل-تعطيل منطقة ',
                'guard_name' => 'web',
                'routes' => 'toggleactive_role'
            ],

            [
                'name' => 'cities',
                'category' => 'المدن',
                'display_name' => 'المدن',
                'guard_name' => 'web',
                'routes' => 'cities.index'
            ],
            [
                'name' => 'add_city',
                'category' => 'المدن',
                'display_name' => 'اضافه مدينة',
                'guard_name' => 'web',
                'routes' => 'cities.create,cities.store'

            ],
            [
                'name' => 'edit_city',
                'category' => 'المدن',
                'display_name' => 'تعديل مدينة',
                'guard_name' => 'web',
                'routes' => 'cities.edit,cities.update'

            ],
            [
                'name' => 'delete_city',
                'category' => 'المدن',
                'display_name' => 'حذف مدينة',
                'guard_name' => 'web',
                'routes' => 'cities.destroy'
            ],

            [
                'name' => 'toggleactive_city',
                'category' => 'المدن',
                'display_name' => ' تفعيل-تعطيل مدينة ',
                'guard_name' => 'web',
                'routes' => 'toggleactive_city'
            ],


            [
                'name' => 'districts',
                'category' => 'الأحياء',
                'display_name' => 'الأحياء',
                'guard_name' => 'web',
                'routes' => 'districts.index'
            ],
            [
                'name' => 'add_district',
                'category' => 'الأحياء',
                'display_name' => 'اضافه حي',
                'guard_name' => 'web',
                'routes' => 'districts.create,districts.store'
            ],
            [
                'name' => 'edit_district',
                'category' => 'الأحياء',
                'display_name' => 'تعديل حي',
                'guard_name' => 'web',
                'routes' => 'districts.edit,districts.update'

            ],
            [
                'name' => 'delete_district',
                'category' => 'الأحياء',
                'display_name' => 'حذف حي',
                'guard_name' => 'web',
                'routes' => 'districts.destroy'
            ],
            [
                'name' => 'toggleactive_district',
                'category' => 'الأحياء',
                'display_name' => ' تفعيل-تعطيل حي ',
                'guard_name' => 'web',
                'routes' => 'toggleactive_district'
            ],

            [
                'name' => 'discountCodes',
                'category' => 'أكواد الخصم',
                'display_name' => 'أكواد الخصم',
                'guard_name' => 'web',
                'routes' => 'discountCodes.index'
            ],
            [
                'name' => 'add_discountCode',
                'category' => 'أكواد الخصم',
                'display_name' => 'اضافه كود خصم',
                'guard_name' => 'web',
                'routes' => 'discountCodes.create,coupons.store'
            ],
            [
                'name' => 'edit_discountCode',
                'category' => 'أكواد الخصم ',
                'display_name' => 'تعديل كود خصم',
                'guard_name' => 'web',
                'routes' => 'discountCodes.edit,discountCodes.update'

            ],
            [
                'name' => 'delete_discountCode',
                'category' => 'أكواد الخصم',
                'display_name' => 'حذف كود خصم',
                'guard_name' => 'web',
                'routes' => 'discountCodes.destroy'
            ],

            [
                'name' => 'ContactUs',
                'category' => 'الاعدادات العامة',
                'display_name' => ' اضافة وسائل التواصل ',
                'guard_name' => 'web',
                'routes' => 'contactus.create,contactus.store'
            ],

            [
                'name' => 'delete_contctus',
                'category' => 'الاعدادات العامة',
                'display_name' => 'حذف  وسائل التواصل',
                'guard_name' => 'web',
                'routes' => 'contactus.destroy'
            ],


            [
                'name' => 'edit_terms_conditions',
                'category' => 'الاعدادات العامة',
                'display_name' => 'تعديل الشروط والأحكام ',
                'guard_name' => 'web',
                'routes' => 'edit_terms_conditions'
            ],
            [
                'name' => 'policies',
                'category' => 'الاعدادات العامة',
                'display_name' => ' تعديل سياسة الخصوصية',
                'guard_name' => 'web',
                'routes' => 'edit_policies'
            ],


            [
                'name' => 'offers',
                'category' => 'العروض',
                'display_name' => 'العروض',
                'guard_name' => 'web',
                'routes' => 'offers.index'
            ],
            [
                'name' => 'add_offer',
                'category' => 'العروض',
                'display_name' => 'اضافه عرض',
                'guard_name' => 'web',
                'routes' => 'offers.create,offers.store'
            ],
            [
                'name' => 'edit_offer',
                'category' => 'العروض',
                'display_name' => 'تعديل عرض',
                'guard_name' => 'web',
                'routes' => 'offers.edit,offers.update'

            ],
            [
                'name' => 'delete_offer',
                'category' => 'العروض',
                'display_name' => 'حذف عرض',
                'guard_name' => 'web',
                'routes' => 'offers.destroy'
            ],

            [
                'name' => 'toggleactive_offer',
                'category' => 'العروض',
                'display_name' => ' تفعيل-تعطيل عرض ',
                'guard_name' => 'web',
                'routes' => 'offers.changeStatus'
            ],

            [
                'name' => 'bike_types',
                'category' => 'انواع الدراجات',
                'display_name' => 'انواع الدراجات',
                'guard_name' => 'web',
                'routes' => 'bike_types.index'
            ],
            [
                'name' => 'add_bike_type',
                'category' => 'انواع الدراجات',
                'display_name' => 'اضافه نوع دراجة',
                'guard_name' => 'web',
                'routes' => 'bike_types.create,bike_types.store'
            ],

            [
                'name' => 'edit_bike_type',
                'category' => 'انواع الدراجات',
                'display_name' => 'تعديل نوع دراجة',
                'guard_name' => 'web',
                'routes' => 'bike_types.edit,bike_types.update'
            ],

            [
                'name' => 'delete_bike_type',
                'category' => 'انواع الدراجات',
                'display_name' => 'حذف نوع دراجة',
                'guard_name' => 'web',
                'routes' => 'bike_types.destroy'
            ],

            [
                'name' => 'toggleactive_bike_type',
                'category' => 'انواع الدراجات',
                'display_name' => ' تفعيل-تعطيل نوع دراجة ',
                'guard_name' => 'web',
                'routes' => 'bike_types.changeStatus'
            ],

            [
                'name' => 'bikes',
                'category' => 'الدراجات',
                'display_name' => 'الدراجات',
                'guard_name' => 'web',
                'routes' => 'bikes.index'
            ],
            [
                'name' => 'add_bike',
                'category' => 'الدراجات',
                'display_name' => 'اضافه دراجه',
                'guard_name' => 'web',
                'routes' => 'bikes.create,bikes.store'

            ],
            [
                'name' => 'edit_biken',
                'category' => 'الدراجات',
                'display_name' => 'تعديل دراجه',
                'guard_name' => 'web',
                'routes' => 'bikes.edit,bikes.update'
            ],
            [
                'name' => 'delete_bike',
                'category' => 'الدراجات',
                'display_name' => 'حذف دراجه',
                'guard_name' => 'web',
                'routes' => 'bikes.destroy'
            ],
            [
                'name' => 'toggleactive_bike',
                'category' => 'الدراجات',
                'display_name' => ' تفعيل-تعطيل دراجه ',
                'guard_name' => 'web',
                'routes' => 'bikes.changeStatus'
            ],
            [
                'name' => 'contact_messages',
                'category' => 'الرسائل',
                'display_name' => 'الرسائل',
                'guard_name' => 'web',
                'routes' => 'contacts.index'
            ],
            [
                'name' => 'contact_messages_reply',
                'category' => 'الرسائل',
                'display_name' => 'رد على الرسائل',
                'guard_name' => 'web',
                'routes' => 'contact_replies.reply'
            ],
            [
                'name' => 'general_settings',
                'category' => 'الاعدادات العامة',
                'display_name' => 'الاعدادات العامة',
                'guard_name' => 'web',
                'routes' => 'general_setting.edit'
            ],
            [
                'name' => 'edit_general_settings',
                'category' => 'الاعدادات العامة',
                'display_name' => 'تعديل الاعدادات العامة',
                'guard_name' => 'web',
                'routes' => 'general_setting.update'
            ],

        ]);

    }


}
