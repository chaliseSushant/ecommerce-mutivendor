<?php

use App\Privilege;
use App\Role;
use Illuminate\Database\Seeder;

class PrivilegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*To apply privileges to a role during development, include privilege in the data variable and add role id to the
        array variable*/

        $data = [
            ['view-vendors', 'View All vendors', 'Is able to view all vendors', ['admin']],
            ['view-payment-gateways', 'View All Payment Gateways', 'Is able to view all Payment Gateways', ['admin']],
            ['view-communications', 'View Communications Menu', 'Is able to view Communications Menu', ['admin']],
            ['view-requests', 'View All vendor Request', 'Is able to view all Requests from vendors to Admin', ['admin']],
            ['view-feedbacks', 'View All Customer Feedback', 'Is able to view all Feedback From Customers', ['admin']],
            ['view-vendor-administrators', 'View All vendor Administrators', 'Is able to view all Users with Administrator Privilege Assigned To vendors', ['admin']],
            ['view-customers', 'View All Customers', 'Is able to view all Users with Customer Role', ['admin']],
            ['view-users', 'View All Users', 'Is able to view all Users', ['admin']],
            ['view-roles', 'View All Roles', 'Is able to view all Users Roles', ['admin']],
            ['view-privileges', 'View All Privileges', 'Is able to view all Privileges', ['admin']],
            ['view-general-settings', 'View General Settings', 'Is able to view General Settings', ['admin']],
            ['view-units', 'View All Units', 'Is able to view all Units', ['admin']],
            ['view-admin-reports', 'View Admin Reports', 'Is able to view Admin Reports', ['admin']],
            ['view-vendor-reports', 'View Vendor Reports', 'Is able to view Vendor Reports', ['vendor']],
            ['view-reports', 'View Reports', 'Is able to view Reports', ['admin','vendor']],
            ['view-orders', 'View Administrator Orders', 'Is able to view Administrator Orders', ['admin']],
            ['view-shipping-person', 'View Shipping Person', 'Is able to view Shipping Person', ['admin']],
            ['view-shipping-settings', 'View Shipping Settings', 'Is able to view Shipping Settings', ['admin']],
            ['view-hero-slider', 'View Hero Slider', 'Is able to view Hero Slider', ['admin']],
            ['view-page-manager', 'View Page Manager', 'Is able to view Page Manager', ['admin']],
            ['view-user-management', 'View User Management', 'Is able to view User Management', ['admin']],
            ['view-address-management', 'View Address Management', 'Is able to view Address Management', ['admin']],

            ['add/edit/delete-vendors', 'Add/Edit/Delete Vendor', 'Is able to add ,edit and delete vendor', ['admin']],
            ['add/edit/delete-vendor-products', 'Add/Edit/Delete Vendor Products', 'Is able to add ,edit and delete vendor products', ['admin','vendor']],
            ['add/edit/delete-roles', 'Add/Edit/Delete User Roles', 'Is able to add ,edit and delete user roles', ['admin']],
            ['add/edit/delete-categories', 'Add/Edit/Delete Categories', 'Is able to add ,edit and delete categories', ['admin']],
            ['add/edit/delete-brands', 'Add/Edit/Delete Brands', 'Is able to add ,edit and delete brands', ['admin']],
            ['add/edit/delete-tags', 'Add/Edit/Delete Tags', 'Is able to add ,edit and delete tags', ['admin']],
            ['add/edit/delete-page', 'Add/Edit/Delete Pages', 'Is able to add ,edit and delete page', ['admin']],
            ['add/edit/delete-page', 'Add/Edit/Delete Pages', 'Is able to add ,edit and delete page', ['admin']],
            ['add/edit/delete-menu', 'Add/Edit/Delete Menus', 'Is able to add ,edit and delete menu', ['admin']],
            ['add/edit/delete-address', 'Add/Edit/Delete Address', 'Is able to add ,edit and delete address', ['admin']],
            ['add/edit/delete-hero-slider', 'Add/Edit/Delete Hero Slider', 'Is able to add ,edit and delete hero slider', ['admin']],
            ['add/edit/delete-homepage-layout', 'Add/Edit/Delete Homepage Layout', 'Is able to add ,edit and delete homepage layout', ['admin']],
            ['add/edit/delete-vendors-docs', 'Add/Edit/Delete Vendor Documents', 'Is able to add ,edit and delete vendor documents', ['admin','vendor']],
            ['add/edit/delete-product-specification-values', 'Add/Edit/Delete Product Specifications Values', 'Is able to add ,edit and delete Product Specifications Values', ['admin','vendor']],
            ['add/edit/delete-vendor-outlets', 'Add/Edit/Delete Vendor Outlets', 'Is able to add ,edit and delete Vendor Outlets', ['admin','vendor']],
            ['add/edit/delete-product-specifications', 'Add/Edit/Delete Product Specifications', 'Is able to add ,edit and delete Product Specifications', ['admin']],
            ['update-vendor-product-status', 'Update Status of Product', 'Is able to status of product', ['admin','vendor']],
            ['update-vendor-details', 'Update Vendor Details', 'Is able to update vendor details', ['admin','vendor']],
            ['change-vendor-status', 'Change Vendor Status', 'Is able to change vendor status', ['admin']],
            ['certify-vendors', 'Certify Vendor', 'Is able to certify vendor', ['admin']],
            ['approve-vendors', 'Approve Vendor', 'Is able to approve vendor', ['admin']],


            ['view-vendor-manage-products', 'View Manage Products Menu', 'Is able to view Manage Products Menu', ['vendor', 'employee']],
            ['view-vendor-manage-outlets', 'View Manage Outlets', 'Is able to view Manage Outlets', ['vendor', 'employee']],
            ['view-vendor-products', 'View vendor Products', 'Is able to view all Products', ['admin', 'vendor']],
            ['view-categories', 'View vendor Product Categories', 'Is able to view all Categories', ['admin', 'employee']],
            ['view-brands', 'View Brands', 'Is able to view all Brands', ['admin']],
            ['view-tags', 'View Tags', 'Is able to view all Tags', ['admin']],
            ['view-product-specifications', 'View vendor Product Specifications', 'Is able to view all Units', ['admin', 'employee']],
            ['view-products-attributes', 'View Product Attributes', 'Is able to view Products Attributes', ['admin', 'employee']],
            ['view-product-specification-values', 'View Product Specifications Values', 'Is able to view all Product Specifications Values', ['admin', 'vendor']],
            ['view-payment-apis', 'View vendor Payment APIs', 'Is able to view all payment APIS', ['admin']],
            ['view-employees', 'View vendor Employees', 'Is able to view all Employees', ['admin']],
            ['view-menus', 'View vendor Menus', 'Is able to view all Menus', ['admin']],
            ['view-orders', 'View Order', 'Is able to view all Orders', ['admin', 'employee']],
            ['view-vendor-orders', 'View vendor Order', 'Is able to view all Vendor Orders', ['vendor']],
            ['view-order-history', 'View Order History', 'Is able to view all Order History', ['admin']],
            ['view-vendor-order-history', 'View vendor Order History', 'Is able to view all Order History', ['admin', 'employee']],
            ['view-vendor-dashboard', 'View All Dashboard Menu', 'Is able to view Dashboard', ['vendor', 'employee']],
            ['view-vendor-analytics', 'View vendor Analytics', 'Is able to view Analytics', ['vendor', 'employee']],
            ['view-vendor-requests', 'View vendor Request To Administrator', 'Is able to view all Units', ['admin', 'employee']],
            ['view-homepage-layout', 'View Homepage Layout', 'Is able to view homepage layout', ['admin']],
            ['view-vendor-general-setting', 'View Vendor General Setting', 'Is able to view vendor general setting', ['vendor']],
            ['manage-multiple-vendor-product', 'Manage Multiple Vendor Product', 'Is able to manage multiple vendor product', ['admin']],
            ['manage-multiple-vendor-outlet', 'Manage Multiple Vendor Outlet', 'Is able to manage multiple vendor outlet', ['admin']],

            ['add-to-cart', 'Add Items To Cart', 'Is able to add items to cart for purchase', ['customer']],
            ['view-self-cart', 'Visit Cart Page', 'Is able to view personal cart', ['customer']],
            ['manage-self-cart', 'Manage Personal Cart Page', 'Is able to edit or delete items in personal cart', ['customer']],
            ['manage-self-account', 'Manage Personal Account Page', 'Is able to edit personal account', ['customer']],
        ];
        foreach ($data as $datum) {
            $priv = new Privilege();
            $priv->privilege = $datum[0];
            $priv->name = $datum[1];
            $priv->description = $datum[2];
            $priv->save();
            foreach ($datum[3] as $role) {
                $priv->roles()->attach(Role::where('role', $role)->first()->id);
            }
        }
    }
}
