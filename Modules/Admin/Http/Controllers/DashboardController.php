<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{

    public function headerColumns($deleted = false)
    {
        return array(
            ['SL', 'SL', 'text-center', 'width: 8% !important'],
            ['log', 'log'],
            ['read_receipt', 'read_receipt'],
            ['actions', 'actions', 'text-center', 'width: 20% !important']
        );
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $title = 'Dashboard';
        return view('admin::index', compact('title'));

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */

    public function notification()
    {
        $logs = Log::when(!datatableOrdering(), function ($query) {
            return $query->orderby('id', 'desc');
        })->when(isset(auth()->user()->id), function ($query) {
            return $query->whereIn('notification_event_id', auth()->user()->assginNotificationEvents->pluck('pivot.notification_event_id')->toArray());
        });

        $options = [
            'read-logs' => auth()->user()->hasPermissionTo('read-logs'),
        ];

        try {
            if (request()->ajax()) {
                return Datatables::of($logs)
                    ->addIndexColumn()
                    ->editColumn('read_receipt', function ($values) {
                        $trimmedString = substr($values->read_by, 1, -1);
                        $arr = explode(',', $trimmedString);
                        $status = '';
                        if ($values->read_by !== null && in_array(auth()->user()->id, $arr)) {

                            $status .= '<button class="btn btn-success btn-sm">Yes</button>';
                        } else {
                            $status .= '<button class="btn btn-info btn-sm">No</button>';
                        }
                        return $status;
                    })
                    ->addColumn('actions', function ($values) use ($options) {
                        $actions = '';

                        if ($options['read-logs']) {

                            $actions .= '<a href="javascript:void(0)"  onclick="Show($(this))" data-title="Read Notification" data-src="'
                                . route('notification.read', $values->id) . '" class="btn btn-warning btn-sm mb-2"><i class="mdi mdi-eye-circle" title="Click to Read"></i></a> ';
                        }

                        return $actions;
                    })
                    ->rawColumns(['read_receipt', 'actions'])
                    ->make(true);
            }

            return view('admin::dashboard.notification', [
                'title' => 'Notification',
                'headerColumns' => $this->headerColumns()
            ]);
        } catch (\Throwable $th) {
            return $this->backWithError($th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function notificationRead($id)
    {
        $notification = Log::findOrFail($id);
        $read_by = !empty($notification->read_by) ? json_decode($notification->read_by, true) : [];
        array_push($read_by, auth()->user()->id);
        $notification->read_by = json_encode($read_by);
        $notification->save();

        return view('admin::dashboard.notification-show', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {

            $type = Log::findOrFail($id);
            $type->fill($request->all());
            $type->read_receipt = 'yes';
            $type->save();

            DB::commit();
            return $this->backWithSuccess('Notification read successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }


}
