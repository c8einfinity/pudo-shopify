CREATE TABLE pudo_delivery_information
(
    id              int not null,
    pudo_locker     varchar(255) default '',
    pudo_source     varchar(100) default 'locker', -- address, locker, shopify
    pudo_method     varchar(100) default 'pickup',
    parcel_size     varchar(100) default 'small',
    street_address  text,
    suburb          varchar(200),
    city            varchar(200) default '',
    province        varchar(255) default '',
    country         varchar(255) default '',
    postal_code     varchar(255) default '',
    contact_name    varchar(255) default '',
    email           varchar(255) default '',
    phone           varchar(100) default '',
    request_transaction_id  varchar(200) default '',
    shopify_order_id        varchar(200) default '',
    created_at      timestamp    default CURRENT_TIMESTAMP,
    updated_at      timestamp    default null,
    shop varchar(200) default '',
    primary key (id)
)