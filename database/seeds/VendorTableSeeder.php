<?php

use App\Outlet;
use App\PaymentGateway;
use App\User;
use App\Vendor;
use App\VendorSetting;
use App\VendorType;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor_type = new VendorType();
        $vendor_type->title = 'General';
        $vendor_type->save();

        $store = new Vendor();
        $store->name = 'Falano Kirana Store';
        $store->phone = '8888888888';
        $store->status = true;
        $store->vendor_type_id = 1;
        $store->save();
        $vendor_setting = new VendorSetting();
        $vendor_setting->vendor_id = $store->id;
        $vendor_setting->save();


        $store = new Vendor();
        $store->name = 'Dhiskano Bhandar';
        $store->phone = '9999999999';
        $store->status = true;
        $store->vendor_type_id = 1;
        $store->save();
        $vendor_setting = new VendorSetting();
        $vendor_setting->vendor_id = $store->id;
        $vendor_setting->save();

        $store = new Vendor();
        $store->name = 'ABC Store';
        $store->phone = '7777777777';
        $store->status = true;
        $store->vendor_type_id = 1;
        $store->save();
        $vendor_setting = new VendorSetting();
        $vendor_setting->vendor_id = $store->id;
        $vendor_setting->save();

        $outlet = new Outlet();
        $outlet->name = "Hetauda Branch";
        $outlet->vendor_id = 1;
        $outlet->address_01 = "Ajar Amar Road, Ward - 4";
        $outlet->district_id = 35;
        $outlet->save();

        $outlet = new Outlet();
        $outlet->name = "Kathmandu Branch";
        $outlet->vendor_id = 1;
        $outlet->address_01 = "Koteshowr, Ward - 32";
        $outlet->district_id = 28;
        $outlet->save();


        $user = User::where('name', 'Vendor')->first();
        $user->vendor_id = Vendor::where('name', 'Falano Kirana Store')->first()->id;
        $user->save();

        $pg = new PaymentGateway();
        $pg->esewa_enable = 0;
        $pg->esewa_secret_key = '';
        $pg->esewa_public_key = '';
        $pg->khalti_enable = 0;
        $pg->khalti_secret_key = 'test_secret_key_f59e8b7d18b4499ca40f68195a846e9b';
        $pg->khalti_public_key = 'test_public_key_dc74e0fd57cb46cd93832aee0a390234';
        $pg->fonepay_enable = 0;
        $pg->fonepay_qr = '';
        $pg->cod_enable = 1;
        $pg->save();


    }
}
