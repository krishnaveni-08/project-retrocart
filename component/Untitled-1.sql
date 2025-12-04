SELECT p.* 
FROM products p
INNER JOIN merchant_details m ON p.merchant_id = m.id
WHERE p.category = 'RetroGames' 
AND p.product_id != 22 
AND p.status = 'active'
AND m.status = 'active'
ORDER BY p.product_id ASC 
LIMIT 4;

SELECT category, COUNT(*) as category_count 
FROM products 
WHERE category = 'RetroGames'
GROUP BY category;