    SELECT 
        cs.vehicle_id,
        cs.model,
        cs.available_stock,
        cs.sold_stock,
        ci.price,
        (cs.sold_stock * ci.price) AS balance
    FROM car_stock cs
    JOIN cars_inventory ci ON cs.vehicle_id = ci.vehicle_id
    ORDER BY cs.vehicle_id
;