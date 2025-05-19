CREATE OR REPLACE FUNCTION Get_Total_Spent_By_Customer (
    p_customer_id IN NUMBER
) RETURN NUMBER
IS
    v_total_spent NUMBER := 0;
BEGIN
    SELECT NVL(SUM(ci.Price), 0)
    INTO v_total_spent
    FROM Transactions t
    JOIN Cars_Inventory ci ON t.Vehicle_ID = ci.Vehicle_ID
    WHERE t.Customer_ID = p_customer_id;

    RETURN v_total_spent;
EXCEPTION
    WHEN OTHERS THEN
        RETURN -1;  -- Indicates an error
END;
/
