CREATE TABLE pudo_shop_settings (
    id              int not null,
    pudo_account_code varchar(50) default '',
    pudo_account_id varchar (200) default '',
    pudo_api_url varchar(255) default '',
    taxable int default 0,
    tax_rate real default 15.00,
    insure int default 0,
    generic_waybill_description int,
    markup real default 0.00,
    free_shipping int,
    free_shipping_amount real,
    locker_to_locker_special int default 0, -- hit up api
    type_of_pickup text,
    created_at     timestamp    default CURRENT_TIMESTAMP,
    updated_at     timestamp    default null,
    shop varchar(200) default '',
    primary key (id)
);