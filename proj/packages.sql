CREATE OR REPLACE PACKAGE car_sales_pkg AS
    PROCEDURE process_sale(
        p_transaction_id NUMBER,
        p_customer_id NUMBER,
        p_vehicle_id NUMBER,
        p_sale_date DATE,
        p_employee_id VARCHAR2
    );

    FUNCTION get_customer_spending(
        p_customer_id NUMBER
    ) RETURN NUMBER;
END car_sales_pkg;

CREATE OR REPLACE PACKAGE BODY car_sales_pkg AS

    PROCEDURE process_sale(
        p_transaction_id NUMBER,
        p_customer_id NUMBER,
        p_vehicle_id NUMBER,
        p_sale_date DATE,
        p_employee_id VARCHAR2
    ) IS
        v_price NUMBER;
        v_model VARCHAR2(50);
    BEGIN
        -- Get vehicle price and model
        SELECT Price, Model INTO v_price, v_model
        FROM Cars_Inventory
        WHERE Vehicle_ID = p_vehicle_id;

        -- Insert transaction
        INSERT INTO Transactions (Transaction_ID, Customer_ID, Vehicle_ID, Sale_Date)
        VALUES (p_transaction_id, p_customer_id, p_vehicle_id, p_sale_date);

        -- Update stock: decrement available, increment sold
        UPDATE Car_Stock
        SET Available_Stock = Available_Stock - 1,
            Sold_Stock = Sold_Stock + 1
        WHERE Vehicle_ID = p_vehicle_id;

        -- Insert audit log
        INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
        VALUES (
            'Transactions',
            'INSERT',
            p_employee_id,
            'Transaction_ID=' || p_transaction_id ||
            ', Customer_ID=' || p_customer_id ||
            ', Vehicle_ID=' || p_vehicle_id ||
            ', Sale_Date=' || TO_CHAR(p_sale_date, 'YYYY-MM-DD')
        );
    END process_sale;


    FUNCTION get_customer_spending(
        p_customer_id NUMBER
    ) RETURN NUMBER IS
        v_total_spent NUMBER := 0;
    BEGIN
        SELECT SUM(ci.Price)
        INTO v_total_spent
        FROM Transactions t
        JOIN Cars_Inventory ci ON t.Vehicle_ID = ci.Vehicle_ID
        WHERE t.Customer_ID = p_customer_id;

        RETURN NVL(v_total_spent, 0);
    END get_customer_spending;

END car_sales_pkg;

