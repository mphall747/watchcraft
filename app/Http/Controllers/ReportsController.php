<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    // Retrieves data for instore tickets and sends it to the tickets view as $tickets
    public function instore()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 1
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for tickets to be sent to the workshop and sends it to the tickets view as $tickets
    public function send()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 2
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for workshop tickets and sends it to the tickets view as $tickets
    public function workshop()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 3
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for tickets to be returned to store and sends it to the tickets view as $tickets
    public function return()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 4
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for tickets ready for payment and sends it to the tickets view as $tickets
    public function complete()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 5
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for paid tickets and sends it to the tickets view as $tickets
    public function paid()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            WHERE tickets.ticket_category_code = 6
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for all tickets and sends it to the tickets view as $tickets
    public function all()
    {
        $tickets = DB::select("
            SELECT
                tickets.ticket_id,
                ticket_categories.name,
                branches.location
            FROM
                tickets
            INNER JOIN ticket_categories ON tickets.ticket_category_code = ticket_categories.ticket_category_code
            INNER JOIN branches ON tickets.branch_id = branches.branch_id
            ORDER BY tickets.ticket_category_code, tickets.ticket_id DESC;
        ");

        return view('tickets/tickets')->with('tickets', $tickets);
    }

    // Retrieves data for all customers and sends it to the customers view as $customers
    public function customers()
    {
        $customers = DB::select("
            SELECT
                customers.customer_id,
                customers.first_name,
                customers.last_name
            FROM 
                customers
            ORDER BY customers.customer_id DESC;
        ");

        return view('customers/customers')->with('customers', $customers);
    }

    // Retrieves data for the selected inventory and sends it to the inventories view as $inventory
    public function inventories($id)
    {
        $inventory = DB::select("
            SELECT
                inventories.part_id,
                parts.name,
                inventories.quantity,
                inventories.branch_id
            FROM 
                inventories
            INNER JOIN parts ON inventories.part_id = parts.part_id
            WHERE 
                inventories.branch_id = '$id';
        ");

        $branch = DB::select("SELECT * FROM branches WHERE branch_id = '$id'");

        return view('inventories/inventories')->with('inventory', $inventory)->with('branch', $branch);
    }

    // Retrieves data for parts and sends it to the parts view as $parts
    public function parts()
    {
        $parts = DB::select("
            SELECT
                parts.part_id,
                parts.name AS p_name,
                suppliers.name AS s_name,
                suppliers.web_address
            FROM 
                parts
            INNER JOIN suppliers ON parts.supplier_id = suppliers.supplier_id
        ");

        return view('inventories/parts/parts')->with('parts', $parts);
    }

    // Retrieves data for suppliers and sends it to the suppliers view as $suppliers
    public function suppliers()
    {
        $suppliers = DB::select("SELECT * FROM suppliers");

        return view('inventories/suppliers/suppliers')->with('suppliers', $suppliers);
    }
}
