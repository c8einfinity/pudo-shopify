<?php
class PudoShopSettings extends \Tina4\ORM
{
    public $tableName="pudo_shop_settings";
    public $primaryKey="id"; //set for primary key
    //public $fieldMapping = ["id" => "id","pudoAccountCode" => "pudo_account_code","pudoAccountId" => "pudo_account_id","pudoApiUrl" => "pudo_api_url","taxable" => "taxable","taxRate" => "tax_rate","insure" => "insure","genericWaybillDescription" => "generic_waybill_description","markup" => "markup","freeShipping" => "free_shipping","freeShippingAmount" => "free_shipping_amount","lockerToLockerSpecial" => "locker_to_locker_special","typeOfPickup" => "type_of_pickup","createdAt" => "created_at","updatedAt" => "updated_at","shop" => "shop"];
    public $genPrimaryKey=true; //set to true if you want to set the primary key
    //public $ignoreFields = []; //fields to ignore in CRUD
    //public $softDelete=true; //uncomment for soft deletes in crud 
    
	public $id;

    public $pudoApiKey;
	public $pudoAccountCode;
	public $pudoAccountId;
	public $pudoApiUrl;
	public $taxable;
	public $taxRate;
	public $insure;
	public $genericWaybillDescription;
	public $markup;
	public $freeShipping;
	public $freeShippingAmount;
	public $lockerToLockerSpecial;
	public $typeOfPickup;
	public $createdAt;
	public $updatedAt;
	public $shop;
}