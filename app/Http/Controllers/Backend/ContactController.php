<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacts = Contact::find($id);
        return view('backend.pages.contacts.edit', compact('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('pages.edit')) {
            return abort(403, 'You are not allowed to access this page !');
        }

        $request->validate([
            'corporate_office_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'food_factory_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'argo_factory_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'printing_factory_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $contacts = Contact::find($id);
            if (is_null($contacts)) {
                return redirect()->name('admin.contacts.edit', $contacts->id);
            }

            $contacts->hotline_number = $request->hotline_number;
            $contacts->toll_free_number = $request->toll_free_number;
            $contacts->overseas_number  = $request->overseas_number;
            $contacts->email = $request->email;
            $contacts->corporate_office_title = $request->corporate_office_title;
            $contacts->corporate_office_address = $request->corporate_office_address;
            if ($request->corporate_office_image) {
                $contacts->corporate_office_image = UploadHelper::update('image', $request->corporate_office_image, $request->corporate_office_title . '-' . time(), 'public/assets/backend/images/contact', $contacts->corporate_office_image);
            }
            $contacts->food_factory_title = $request->food_factory_title;
            $contacts->food_factory_address = $request->food_factory_address;
            if ($request->food_factory_image) {
                $contacts->food_factory_image = UploadHelper::update('image', $request->food_factory_image, $request->food_factory_title . '-' . time(), 'public/assets/backend/images/contact', $contacts->food_factory_image);
            }
            $contacts->argo_factory_title = $request->argo_factory_title;
            $contacts->argo_factory_address = $request->argo_factory_address;
            if ($request->argo_factory_image) {
                $contacts->argo_factory_image = UploadHelper::update('image', $request->argo_factory_image, $request->argo_factory_title . '-' . time(), 'public/assets/backend/images/contact', $contacts->argo_factory_image);
            }
            $contacts->printing_factory_title = $request->printing_factory_title;
            $contacts->printing_factory_address = $request->printing_factory_address;
            if ($request->printing_factory_image) {
                $contacts->printing_factory_image = UploadHelper::update('image', $request->printing_factory_image, $request->printing_factory_title . '-' . time(), 'public/assets/backend/images/contact', $contacts->printing_factory_image);
            }
            $contacts->created_at = Carbon::now();
            $contacts->updated_at = Carbon::now();
            $contacts->save();

            Track::newTrack('Contact Updated', 'Contact updated');

            DB::commit();
            session()->flash('success', 'Contact has been updated successfully !!');

            return redirect()->route('admin.contacts.edit', $contacts->id);
        } catch (\Exception $e) {
            // session()->flash('db_error', 'Error On: '."File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            session()->flash('db_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
