CREATE OR REPLACE PROCEDURE Process_Car_Sale (
    p_customer_id IN NUMBER,
    p_vehicle_id  IN NUMBER,
    p_sale_date   IN DATE
)
IS
    v_available_stock NUMBER;
    v_transaction_id  NUMBER;
    v_dummy           NUMBER;
BEGIN
    -- Check if customer exists
    BEGIN
        SELECT 1 INTO v_dummy FROM Customers WHERE Customer_ID = p_customer_id;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RAISE_APPLICATION_ERROR(-20001, '❌ Customer ID not found.');
    END;

    -- Check if vehicle exists
    BEGIN
        SELECT 1 INTO v_dummy FROM Cars_Inventory WHERE Vehicle_ID = p_vehicle_id;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RAISE_APPLICATION_ERROR(-20002, '❌ Vehicle ID not found.');
    END;

    -- Check stock
    SELECT Available_Stock INTO v_available_stock
    FROM Car_Stock
    WHERE Vehicle_ID = p_vehicle_id;

    IF v_available_stock <= 0 THEN
        RAISE_APPLICATION_ERROR(-20003, '❌ Vehicle is out of stock.');
    END IF;

    -- Generate new transaction ID
    SELECT NVL(MAX(Transaction_ID), 0) + 1 INTO v_transaction_id FROM Transactions;

    -- Insert transaction
    INSERT INTO Transactions (Transaction_ID, Customer_ID, Vehicle_ID, Sale_Date)
    VALUES (v_transaction_id, p_customer_id, p_vehicle_id, p_sale_date);

    -- Update stock
    UPDATE Car_Stock
    SET Available_Stock = Available_Stock - 1,
        Sold_Stock = Sold_Stock + 1
    WHERE Vehicle_ID = p_vehicle_id;

    COMMIT;

    DBMS_OUTPUT.PUT_LINE('✅ Sale completed. Transaction ID: ' || v_transaction_id);

EXCEPTION
    WHEN OTHERS THEN
        ROLLBACK;
        DBMS_OUTPUT.PUT_LINE('❌ Error: ' || SQLERRM);
END;
