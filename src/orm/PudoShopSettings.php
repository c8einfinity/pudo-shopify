<?php
class PudoShopSettings extends \Tina4\ORM
{
    public $tableName="pudo_shop_settings";
    public $primaryKey="id"; //set for primary key
    public $genPrimaryKey=true; //set to true if you want to set the primary key
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
    public $pudoSourceLocker;
    public $sourceAddressLine1;
    public $sourceAddressLine2;
    public $sourceAddressLine3;
    public $sourceCity;
    public $sourceSuburb;
    public $sourcePostalCode;

    public $testMode;
}