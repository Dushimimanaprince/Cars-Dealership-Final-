CREATE OR REPLACE TRIGGER trg_audit_transaction_insert
AFTER INSERT ON Transactions
FOR EACH ROW
DECLARE
    v_new_value CLOB;
BEGIN
    v_new_value := 'Transaction_ID=' || :NEW.Transaction_ID || 
                   ', Customer_ID=' || :NEW.Customer_ID || 
                   ', Vehicle_ID=' || :NEW.Vehicle_ID || 
                   ', Sale_Date=' || TO_CHAR(:NEW.Sale_Date, 'YYYY-MM-DD');

    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Transaction',
        'INSERT',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        v_new_value
    );
END;
/

-- INSERT Trigger
CREATE OR REPLACE TRIGGER trg_audit_customers_insert
AFTER INSERT ON Customers
FOR EACH ROW
DECLARE
    v_new_value CLOB;
BEGIN
    v_new_value := 'Customer_ID=' || :NEW.Customer_ID || 
                   ', Customer_Name=' || :NEW.Name || 
                   ', Customer_Contact=' || :NEW.Contact_Number || 
                   ', Customer_Email=' || :NEW.Email;

    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Customers',
        'INSERT',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        v_new_value
    );
END;

CREATE OR REPLACE TRIGGER trg_audit_employees_insert
AFTER INSERT ON Employees
FOR EACH ROW
DECLARE
    v_new_value CLOB;
BEGIN
    v_new_value := 'Employee_ID=' || :NEW.Employee_ID || 
                   ', Employee_Name=' || :NEW.Name || 
                   ', Employee_Role=' || :NEW.Role || 
                   ', Employee_Contact=' || :NEW.Contact_Number;

    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Employees',
        'INSERT',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        v_new_value
    );
END;

CREATE OR REPLACE TRIGGER trg_audit_cars_inventory_insert
AFTER INSERT ON Cars_Inventory
FOR EACH ROW
DECLARE
    v_new_value CLOB;
BEGIN
    v_new_value := 'Vehicle_ID=' || :NEW.Vehicle_ID || 
                   ', Make=' || :NEW.Make || 
                   ', Model=' || :NEW.Model || 
                   ', Price=' || :NEW.Price ;

    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Cars_Inventory',
        'INSERT',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        v_new_value
    );
END;

CREATE OR REPLACE TRIGGER trg_audit_car_stock_insert
AFTER INSERT ON Car_Stock
FOR EACH ROW
DECLARE
    v_new_value CLOB;
BEGIN
    v_new_value := 'Vehicle_ID=' || :NEW.Vehicle_ID || 
                   ', Availability_Stock=' || :NEW.Available_Stock ||
                   ', Model=' || :NEW.Model || 
                   ', Sold_Stock=' || :NEW.Sold_Stock;

    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Car_Stock',
        'INSERT',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        v_new_value
    );
END;


CREATE OR REPLACE TRIGGER trg_audit_customers_del
AFTER DELETE ON Customers
FOR EACH ROW
BEGIN
    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Customers',
        'DELETE',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        'ID=' || :OLD.Customer_ID || ', Name=' || :OLD.Name
    );
END;
create or replace TRIGGER trg_audit_customers_upd
AFTER UPDATE ON Customers
FOR EACH ROW
BEGIN
    INSERT INTO Audit_Log (Table_Name, Operation, Changed_By, New_Value)
    VALUES (
        'Customers',
        'UPDATE',
        SYS_CONTEXT('USERENV', 'SESSION_USER'),
        'ID=' || :NEW.Customer_ID || ', Name=' || :NEW.Name
    );
END;


