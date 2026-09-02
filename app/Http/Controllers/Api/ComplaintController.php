<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Doctor;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    // ========================
    // GET ALL
    // ========================
    public function index()
    {
        $complaints = Complaint::latest()->get();

        return response()->json([
            'msg' => 'Return all complaints',
            'status' => 200,
            'complaints' => $complaints
        ], 200);
    }

    // ========================
    // GET BY ID
    // ========================
    public function show($id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {

            return response()->json([
                'msg' => 'Complaint not found',
                'status' => 404,
                'complaint' => null
            ], 404);
        }

        return response()->json([
            'msg' => 'Complaint found',
            'status' => 200,
            'complaint' => $complaint
        ], 200);
    }

    // ========================
    // STORE
    // ========================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'sender_type' => 'required|in:doctor,parent',

            'sender_id' => 'required|integer',

            'full_name' => 'required|string|max:255',

            'email' => 'required|email',

            'subject' => 'required|string|max:255',

            'message' => 'required|string',

            'screenshot' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // ========================
        // CHECK SENDER
        // ========================

        if ($request->sender_type == 'doctor') {

            $exists = Doctor::where('id', $request->sender_id)->exists();

            $senderType = Doctor::class;

        } else {

            $exists = Parents::where('id', $request->sender_id)->exists();

            $senderType = Parents::class;
        }

        if (!$exists) {

            return response()->json([
                'msg' => 'Invalid sender id',
                'status' => 404
            ], 404);
        }

        // ========================
        // IMAGE
        // ========================

        $screenshotPath = null;

        if ($request->hasFile('screenshot')) {

            $screenshotPath = $request
                ->file('screenshot')
                ->storeAs(
                    'complaints',
                    time() . '_' . $request->file('screenshot')->getClientOriginalName(),
                    'public'
                );
        }

        // ========================
        // CREATE
        // ========================

        $complaint = Complaint::create([

            'sender_type' => $senderType,

            'sender_id' => $request->sender_id,

            'full_name' => $request->full_name,

            'email' => $request->email,

            'subject' => $request->subject,

            'message' => $request->message,

            'screenshot_path' => $screenshotPath,

            'status' => 'pending',
        ]);

        // ========================
        // SEND EMAIL
        // ========================

        
        Mail::raw($request->message, function ($mail) use ($request, $screenshotPath) {

            $mail->to('rafiqteamsupport@gmail.com')
                ->subject($request->subject);

            if ($screenshotPath) {
                $mail->attach(
                    storage_path('app/public/' . $screenshotPath),
                    [
                        'as' => $request->file('screenshot')->getClientOriginalName()
                    ]
                );
            }
        });
        

        return response()->json([
            'msg' => 'Complaint created successfully',
            'status' => 201,
            'complaint' => $complaint
        ], 201);
    }

    // ========================
    // UPDATE
    // ========================
    public function update(Request $request)
    {
        $old_id = $request->old_id;

        $complaint = Complaint::find($old_id);

        if (!$complaint) {

            return response()->json([
                'msg' => 'Complaint not found',
                'status' => 404,
                'complaint' => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [

            'full_name' => 'required|string|max:255',

            'email' => 'required|email',

            'subject' => 'required|string|max:255',

            'message' => 'required|string',

            'status' => 'nullable|in:pending,resolved,rejected',

            'admin_notes' => 'nullable|string',

            'screenshot' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'msg' => 'Validation errors',
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // ========================
        // IMAGE
        // ========================

        $screenshotPath = $complaint->screenshot_path;

        if ($request->hasFile('screenshot')) {

            $screenshotPath = $request
                ->file('screenshot')
                ->store('complaints', 'public');
        }

        // ========================
        // UPDATE
        // ========================

        DB::table('complaints')
            ->where('id', $old_id)
            ->update([

                'full_name' => $request->full_name,

                'email' => $request->email,

                'subject' => $request->subject,

                'message' => $request->message,

                'status' => $request->status ?? $complaint->status,

                'admin_notes' => $request->admin_notes,

                'screenshot_path' => $screenshotPath,

                'updated_at' => now(),
            ]);

        $updated = Complaint::find($old_id);

        return response()->json([
            'msg' => 'Complaint updated successfully',
            'status' => 200,
            'complaint' => $updated
        ], 200);
    }

    // ========================
    // DELETE
    // ========================
    public function delete($id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {

            return response()->json([
                'msg' => 'Complaint not found',
                'status' => 404,
                'complaint' => null
            ], 404);
        }

        $complaint->delete();

        return response()->json([
            'msg' => 'Complaint deleted successfully',
            'status' => 200,
            'complaint' => null
        ], 200);
    }
}