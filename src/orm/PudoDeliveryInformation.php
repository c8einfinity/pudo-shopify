<?php
class PudoDeliveryInformation extends \Tina4\ORM
{
    public $tableName="pudo_delivery_information";
    public $primaryKey="id"; //set for primary key
    //public $fieldMapping = ["id" => "id","pudoLocker" => "pudo_locker","pudoSource" => "pudo_source","pudoMethod" => "pudo_method","parcelSize" => "parcel_size","streetAddress" => "street_address","suburb" => "suburb","city" => "city","province" => "province","country" => "country","postalCode" => "postal_code","contactName" => "contact_name","email" => "email","phone" => "phone","requestTransactionId" => "request_transaction_id","shopifyOrderId" => "shopify_order_id","createdAt" => "created_at","updatedAt" => "updated_at","shop" => "shop"];
    public $genPrimaryKey=true; //set to true if you want to set the primary key
    //public $ignoreFields = []; //fields to ignore in CRUD
    //public $softDelete=true; //uncomment for soft deletes in crud 
    
	public $id;
	public $pudoLocker;
	public $pudoSource;
	public $pudoMethod;
	public $parcelSize;
	public $streetAddress;
	public $suburb;
	public $city;
	public $province;
	public $country;
	public $postalCode;
	public $contactName;
	public $email;
	public $phone;
	public $requestTransactionId;
	public $shopifyOrderId;
	public $createdAt;
	public $updatedAt;
	public $shop;
}