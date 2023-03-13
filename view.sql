CREATE OR REPLACE VIEW itemsview AS
SELECT items.* , categories.* FROM items
INNER JOIN categories on items.items_cat = categories.categories_id

SELECT items1view.* , 1 as favorite FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = 2
UNION ALL
SELECT * , 0 as favorite FROM items1view
WHERE  items_id != (SELECT items1view.items_id FROM items1view
INNER JOIN favorite ON favorite.favorite_itemsid = items1view.items_id AND favorite.favorite_usersid = 2)

CREATE OR REPLACE VIEW myfavorite AS


SELECT favorite.*, users.users_id, items.* FROM favorite

INNER JOIN users ON users.users_id = favorite.favorite_usersid
INNER JOIN items ON items.items_id = favorite.favorite_itemsid


CREATE OR REPLACE VIEW cartview AS 
SELECT SUM(items.items_price) as itemsprice, COUNT(cart_itemsid) as countitems, cart.*, items.* FROM cart
INNER JOIN items ON items.items_id = cart.cart_itemsid
GROUP BY cart.cart_itemsid , cart.cart_usersid
