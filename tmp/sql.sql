# всего товаров
SELECT count(*) FROM `store_products` SP JOIN variants V ON SP.id = V.product_id;

# все товары 4500
SELECT * FROM `store_products` SP JOIN variants V ON SP.id = V.product_id;

# соответстввие первого поставщика  sku 1373
SELECT * FROM `store_products` SP JOIN variants V ON SP.id = V.product_id
  JOIN supplier1_products SP1 ON V.sku = SP1.sku;

# соответстввие первого поставщика  sku 3215
SELECT * FROM `store_products` SP JOIN variants V ON SP.id = V.product_id JOIN supplier2_products SP2 ON V.sku = SP2.sku;

# id поставщиков и колчиество единиц товаров
SELECT supplier_id, count(*) FROM `store_products` GROUP by supplier_id;

# соответствия брендам
SELECT * FROM `brands` B JOIN supplier_products SP ON B.name = SP.brand;

# сводна таблица
SELECT * FROM `store_products` SP LEFT JOIN variants V ON SP.id = V.product_id
  LEFT JOIN brands B ON SP.brand_id = B.id
 JOIN supplier_products SUP ON V.articleCode = SUP.articleCode
#WHERE V.articleCode ='RSH-3375';
WHERE SP.supplier_id = 9183;