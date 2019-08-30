<?php

namespace TaffoVelikoff\HotCoffee\Http\Controllers\Admin;

use Bnb\Laravel\Attachments\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttachmentController extends Controller
{
    /**
     * Delete
     *
     * @param int $id
     */
    public function destroy($id) {

        $att = Attachment::find($id);
        $att->delete();

        // Flash success message
        session()->flash('notify', array(
            'type'      => 'warning',
            'message'   => __('hotcoffee::admin.att_deleted')
        )); 

        return back();
    }
}
