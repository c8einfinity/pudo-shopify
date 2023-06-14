ALTER TABLE pudo_shop_settings rename source_address_line_1 to source_address_line1;
ALTER TABLE pudo_shop_settings rename source_address_line_2 to source_address_line2;
ALTER TABLE pudo_shop_settings rename source_address_line_3 to source_address_line3;
ALTER TABLE pudo_shop_settings add test_mode int default 1;

