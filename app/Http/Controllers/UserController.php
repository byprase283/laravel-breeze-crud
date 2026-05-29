<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Render the main blade view
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Process DataTables AJAX request
     */
    public function getUsersData(Request $request)
    {
        // if ($request->ajax()) {
        // Using Laravel 13 features, you can pass regular queries or utilize attributes
        $data = User::select(['id', 'name', 'email', 'created_at']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('d-m-Y H:i:s') : '-';
            })
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" data-id="' . $row->id . '" class="btn btn-primary btn-sm editUserBtn">Edit</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        // }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Menyimpan perubahan data via AJAX
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'Data user berhasil diperbarui!']);
    }
}
