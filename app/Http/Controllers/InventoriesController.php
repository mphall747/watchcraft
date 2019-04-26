<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoriesController extends Controller
{
    // Insert new supplier and redirect to suppliers report
    public function supplierInsert(Request $request)
    {
        $name = $request->input('supplierName');
        $web = $request->input('supplierWeb');

        DB::statement("
            INSERT INTO 
                suppliers (
                    name,
                    web_address
                )
            VALUES
                ('$name', '$web');
        ");

        // Return to all tickets
        return redirect('inventories/suppliers');
    }

    // Retrieve suppliers and load add part view
    public function partAdd()
    {
        $suppliers = DB::select("SELECT * FROM suppliers");

        // Return to all tickets
        return view('inventories/parts/add')->with('suppliers', $suppliers);
    }

    // Insert new part and redirect to parts report
    public function partInsert(Request $request)
    {
        $supplier = $request->input('partSupplier');
        $name = $request->input('partName');

        DB::statement("
            INSERT INTO 
                parts (
                    supplier_id,
                    name
                )
            VALUES
                ('$supplier', '$name');
        ");

        // Return to all tickets
        return redirect('inventories/parts');
    }

    // Retrieve suppliers, parts and branches and load add inventory view
    public function inventoryAdd1()
    {
        $branches = DB::select("SELECT * FROM branches;");
        $suppliers = DB::select("SELECT * FROM suppliers");

        // Return to all tickets
        return view('inventories/add1')->with('suppliers', $suppliers)->with('branches', $branches);
    }

    // Retrieve suppliers, parts, branches and current inventory and load second add inventory view
    public function inventoryAdd2(Request $request)
    {
        $item_branch = (int) $request->input('itemBranch');
        $item_supplier = (int) $request->input('itemSupplier');

        $branches = DB::select("SELECT * FROM branches;");
        $suppliers = DB::select("SELECT * FROM suppliers");
        $parts = DB::select("SELECT * FROM parts");
        $inventories = DB::select("SELECT part_id FROM inventories WHERE branch_id = '$item_branch'");
        $inventoryArray = array();

        // Create an array of the part_ids in the current inventory
        foreach ($inventories as $inventory)
        {
            array_push($inventoryArray, $inventory->part_id);
        }

        // Return to all tickets
        return view('inventories/add2')
            ->with('suppliers', $suppliers)
            ->with('branches', $branches)
            ->with('parts', $parts)
            ->with('inventories', $inventories)
            ->with('item_branch', $item_branch)
            ->with('item_supplier', $item_supplier)
            ->with('inventoryArray', $inventoryArray);
    }

    // Insert new inventory item and redirect to inventory report
    public function inventoryInsert(Request $request)
    {
        $branch = (int) $request->input('itemBranch');
        $part = (int) $request->input('itemPart');
        $quantity = (int) $request->input('itemQuantity');

        DB::statement("
            INSERT INTO 
                inventories (
                    part_id,
                    branch_id,
                    quantity
                )
            VALUES
                ('$part', '$branch', '$quantity');
        ");

        // Return to all tickets
        return redirect('inventories/id/'.$branch);
    }

    // Get supplier details and load edit view
    public function supplierEdit($id)
    {
        $supplier = DB::select("SELECT * FROM suppliers WHERE supplier_id = '$id'");
        
        return view('inventories/suppliers/edit')->with('supplier', $supplier);
    }

    // Update supplier details and load suppliers view
    public function supplierUpdate($id, Request $request)
    {
        $name = $request->input('supplierName');
        $web = $request->input('supplierWeb');

        DB::statement("
            UPDATE
                suppliers
            SET
                name = '$name',
                web_address = '$web'
            WHERE supplier_id = '$id';
        ");

        return redirect('inventories/suppliers');
    }

        // Get part details and load edit view
        public function partEdit($id)
        {
            $part = DB::select("SELECT * FROM parts WHERE part_id = '$id'");
            $suppliers = DB::select("SELECT * FROM suppliers");
            
            return view('inventories/parts/edit')->with('part', $part)->with('suppliers', $suppliers);
        }
    
        // Update part details and load parts view
        public function partUpdate($id, Request $request)
        {
            $name = $request->input('partName');
            $supplier = $request->input('partSupplier');
    
            DB::statement("
                UPDATE
                    parts
                SET
                    name = '$name',
                    supplier_id = '$supplier'
                WHERE part_id = '$id';
            ");
    
            return redirect('inventories/parts');
        }

        // Get item details and load edit view
        public function edit($branch, $part, Request $request)
        {
            $item = DB::select("
                SELECT
                    inventories.quantity,
                    parts.part_id,
                    parts.name,
                    branches.branch_id,
                    branches.location
                FROM 
                    inventories
                INNER JOIN parts ON inventories.part_id = parts.part_id
                INNER JOIN branches ON inventories.branch_id = branches.branch_id 
                WHERE inventories.branch_id = '$branch' 
                AND inventories.part_id = '$part';
            ");
            
            return view('inventories/edit')->with('item', $item);
        }

        // Update item details and load inventory view
        public function update($branch, $part, Request $request)
        {
            $quantity = $request->input('itemQuantity');

            DB::statement("
                UPDATE
                    inventories
                SET
                    quantity = '$quantity'
                WHERE branch_id = '$branch'
                AND part_id = '$part';
            ");

            return redirect('inventories/id/'.$branch);
        }
}
