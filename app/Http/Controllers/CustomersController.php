<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    // Retrieves data for the customer_id in the url and sends it to the customers/details view.
    public function details($id)
    {
        $customer = DB::select("
            SELECT
                customers.customer_id,
                customers.first_name,
                customers.last_name,
                customers.phone,
                customers.email
            FROM
                customers
            WHERE customers.customer_id = '$id';
        ");

        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name
            FROM
                tickets
            INNER JOIN customers ON tickets.customer_id = customers.customer_id
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            WHERE customers.customer_id = '$id';
        ");

        return view('customers/details')->with('customer', $customer)->with('tickets', $tickets);
    }

    // Insert new customer and redirect to customers report
    public function insert(Request $request)
    {
        $first_name = $request->input('customerFirstName');
        $last_name = $request->input('customerLastName');
        $phone = $request->input('customerPhone');
        $email = $request->input('customerEmail');

        DB::statement("
            INSERT INTO 
                customers (
                    first_name,
                    last_name,
                    phone,
                    email
                )
            VALUES
                ('$first_name', '$last_name', '$phone', '$email');
        ");

        // Return to all tickets
        return redirect('customers');
    }

    // Retrieves data for the customer_id in the url and sends it to the edit view.
    public function edit($id)
    {
        $customer = DB::select("SELECT * FROM customers WHERE customer_id = '$id'");

        return view('customers/edit')->with('customer', $customer);
    }

    // Request post data from edit page and run UPDATE script
    public function update($id, Request $request)
    {
        $first_name = $request->input('customerFirstName');
        $last_name = $request->input('customerLastName');
        $phone = $request->input('customerPhone');
        $email = $request->input('customerEmail');

        DB::statement("
            UPDATE 
                customers
            SET 
                first_name = '$first_name',
                last_name = '$last_name',
                phone = '$phone'
            WHERE customer_id = '$id';
        ");

        // Set other_notes field to null value if no notes are provided
        if (empty($email))
        {
            DB::statement("UPDATE customers SET email = NULL WHERE customer_id = '$id';");
        }
        else
        {
            DB::statement("UPDATE customers SET email = '$email' WHERE customer_id = '$id';");
        }
                
        // Return to ticket details
        return redirect('customers/id/'.$id);
    }

    public function delete($id)
    {
        DB::statement("
            UPDATE
                customers
            SET
                first_name = 'Removed',
                last_name = 'on Request',
                phone = 'Removed',
                email= 'Removed'
            WHERE
                customer_id = '$id';
        ");

        return redirect('/customers/id/'.$id);
    }
}
