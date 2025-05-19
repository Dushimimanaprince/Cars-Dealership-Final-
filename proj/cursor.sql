SET SERVEROUTPUT ON;

DECLARE
    v_vehicle_id Cars_Inventory.Vehicle_ID%TYPE := 5;

    -- Cursor to fetch customer and vehicle info for a given vehicle
    CURSOR cur_customers_by_vehicle IS
        SELECT 
            c.Name AS Customer_Name,
            ci.Make || ' ' || ci.Model AS Vehicle_Name
        FROM 
            Transactions t
            JOIN Customers c ON t.Customer_ID = c.Customer_ID
            JOIN Cars_Inventory ci ON t.Vehicle_ID = ci.Vehicle_ID
        WHERE 
            t.Vehicle_ID = v_vehicle_id;

    -- Variables to hold data from cursor
    v_customer_name Customers.Name%TYPE;
    v_vehicle_name VARCHAR2(100);
BEGIN
    OPEN cur_customers_by_vehicle;
    LOOP
        FETCH cur_customers_by_vehicle INTO v_customer_name, v_vehicle_name;
        EXIT WHEN cur_customers_by_vehicle%NOTFOUND;

        DBMS_OUTPUT.PUT_LINE('Customer: ' || v_customer_name || ' | Vehicle: ' || v_vehicle_name);
    END LOOP;
    CLOSE cur_customers_by_vehicle;
END;
