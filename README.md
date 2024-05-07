# Laravel CRUD with User Roles (Backend)
 
This is a role-based user authentication and authorization CRUD operations system. 3 different user roles (Owner, Manager, Cashier) perform all the operations and each user has permissions and restrictions.

* "Add Items/Add Customers" operations are only done by the Owner. Others should not have privileges for adding Items or Customers.
* Cashiers can "Remove Items" and "Edit Items", but cannot do any other operations.
* Manager can "Update and Delete Customer Details", but cannot do any other operations.
