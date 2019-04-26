<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    // Retrieves data for the ticket_id in the url and sends it to the tickets/details view.
    public function details($id)
    {
        $ticket = DB::select("
            SELECT
                tickets.ticket_id,
                tickets.customer_id,
                tickets.ticket_category_code,
                ticket_categories.name,
                users.name AS e_name,
                branches.location,
                customers.first_name AS c_first_name,
                customers.last_name AS c_last_name,
                customers.email,
                tickets.description,
                tickets.other_notes,
                tickets.date_received,
                completed_tickets.price,
                completed_tickets.date_completed,
                payments.paid_date
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN users ON tickets.employee_id = users.id
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            INNER JOIN customers ON tickets.customer_id = customers.customer_id
            LEFT JOIN completed_tickets ON tickets.ticket_id = completed_tickets.ticket_id
            LEFT JOIN payments ON completed_tickets.ticket_id = payments.ticket_id
            WHERE tickets.ticket_id = '$id'
            ORDER BY tickets.ticket_category_code;
        ");

        return view('tickets/details')->with('ticket', $ticket);
    }

    // Retrieves data required for dropdown inputs and loads the add tickets view
    public function add()
    {
        $categories = DB::select("SELECT * FROM ticket_categories;");
        $branches = DB::select("SELECT * FROM branches;");
        $customers = DB::select("SELECT * FROM customers ORDER BY customer_id DESC;");

        return view('tickets/add')->with('categories', $categories)->with('branches', $branches)->with('customers', $customers);
    }

        // Insert new ticket and redirect to all tickets report
        public function insert(Request $request)
        {
            $category = $request->input('ticketStatus');
            $employee = Auth::id();
            $branch = $request->input('ticketBranch');
            $customer = $request->input('ticketCustomer');
            $description = $request->input('ticketDescription');
            $other_notes = $request->input('ticketNotes');
            $today = date("Y-m-d");

            DB::statement("
                INSERT INTO 
                    tickets (
                        ticket_category_code,
                        employee_id,
                        branch_id,
                        customer_id,
                        description,
                        other_notes,
                        date_received
                    )
                VALUES
                    ('$category', '$employee', '$branch', '$customer', '$description', '$other_notes', '$today');
            ");

            // Return to all tickets
            return redirect('tickets/all');
        }
    

    // Retrieves data for the ticket_id in the url and category data and sends it to the edit view.
    public function edit($id)
    {
        $ticket = DB::select("
            SELECT
                tickets.ticket_id,
                tickets.ticket_category_code,
                ticket_categories.name,
                users.name AS e_name,
                branches.location,
                customers.first_name AS c_first_name,
                customers.last_name AS c_last_name,
                tickets.description,
                tickets.other_notes,
                tickets.date_received,
                completed_tickets.price,
                completed_tickets.date_completed,
                payments.paid_date
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN users ON tickets.employee_id = users.id
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            INNER JOIN customers ON tickets.customer_id = customers.customer_id
            LEFT JOIN completed_tickets ON tickets.ticket_id = completed_tickets.ticket_id
            LEFT JOIN payments ON completed_tickets.ticket_id = payments.ticket_id
            WHERE tickets.ticket_id = '$id'
            ORDER BY tickets.ticket_category_code;
        ");

        $categories = DB::select("SELECT * FROM ticket_categories");

        return view('tickets/edit')->with('ticket', $ticket)->with('categories', $categories);
    }

    // Request post data from edit page and run UPDATE script
    public function update($id, Request $request)
    {
        $description = $request->input('ticketDescription');
        $other_notes = $request->input('ticketNotes');

        DB::statement("
            UPDATE 
                tickets 
            SET 
                description = '$description' 
            WHERE ticket_id = '$id';
        ");

        // Set other_notes field to null value if no notes are provided
        if (empty($other_notes))
        {
            DB::statement("UPDATE tickets SET other_notes = NULL WHERE ticket_id = '$id';");
        }
        else
        {
            DB::statement("UPDATE tickets SET other_notes = '$other_notes' WHERE ticket_id = '$id';");
        }
                
        // Return to ticket details
        return redirect('tickets/id/'.$id);
    }

    // Change ticket status to in workshop ready to complete
    public function receive($id)
    {
        $category = DB::select("SELECT ticket_category_code FROM tickets WHERE ticket_id = '$id';");

        switch ($category[0]->ticket_category_code)
        {
            case 2:
                // Change ticket status
                DB::statement("UPDATE tickets SET ticket_category_code = 3 WHERE ticket_id = '$id';");

                // Return to ticket details
                return redirect('tickets/id/'.$id);
                break;
            default:
                // Return to ticket details
                return redirect('tickets/id/'.$id);
        }
    }

    // Change ticket to completed status and add price
    public function complete($id, Request $request)
    {
        $price = (float) $request->input('ticketPrice');
        $today = date("Y-m-d");
        $category = DB::select("SELECT ticket_category_code FROM tickets WHERE ticket_id = '$id';");

        // Round incorrect prices to 2 decimal places
        $price = round($price, 2);

        switch ($category[0]->ticket_category_code)
        {
            case 1:
                // Change ticket status
                DB::statement("UPDATE tickets SET ticket_category_code = 5 WHERE ticket_id = '$id';");

                // Insert record into completed tickets
                DB::statement("INSERT INTO completed_tickets (ticket_id, price, date_completed) VALUES ('$id', '$price', '$today');");

                // Return to ticket details
                return redirect('tickets/id/'.$id);
                break;
            case 3:
                // Change ticket status
                DB::statement("UPDATE tickets SET ticket_category_code = 4 WHERE ticket_id = '$id';");

                // Insert record into completed tickets
                DB::statement("INSERT INTO completed_tickets (ticket_id, price, date_completed) VALUES ('$id', '$price', '$today');");

                // Return to ticket details
                return redirect('tickets/id/'.$id);
                break;
            default:
                // Return to ticket details
                return redirect('tickets/id/'.$id);
        }
    }

    // Change ticket status to awaiting payment
    public function return($id)
    {
        $category = DB::select("SELECT ticket_category_code FROM tickets WHERE ticket_id = '$id';");

        switch ($category[0]->ticket_category_code)
        {
            case 4:
                // Change ticket status
                DB::statement("UPDATE tickets SET ticket_category_code = 5 WHERE ticket_id = '$id';");

                // Return to ticket details
                return redirect('tickets/id/'.$id);
                break;
            default:
                // Return to ticket details
                return redirect('tickets/id/'.$id);
        }
    }

    // Change ticket status to paid and record it in the payments table
    public function pay($id, Request $request)
    {
        $email = (int) $request->input('invoiceEmail');
        $now = date("Y-m-d H:i:s");
        $category = DB::select("SELECT ticket_category_code FROM tickets WHERE ticket_id = '$id';");

        switch ($category[0]->ticket_category_code)
        {
            case 5:
                // Change ticket status
                DB::statement("UPDATE tickets SET ticket_category_code = 6 WHERE ticket_id = '$id';");

                // Insert record into payments table
                DB::statement("INSERT INTO payments (ticket_id, email_invoice, paid_date) VALUES ('$id', '$email', '$now');");

                // Return to ticket details
                return redirect('tickets/id/'.$id);
                break;
            default:
                // Return to ticket details
                return redirect('tickets/id/'.$id);
        }
    }

}
