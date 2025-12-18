<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trash;
use App\Models\HistoryTakeOutTrash;
use App\Models\Masyarakat;
use App\Models\User;
use App\Models\TrashSchedule;
use App\Models\DetailTrashSchedule;


class TrashController extends Controller
{
    public function index()
    {
        $trashes = Trash::all();
        return response()->json([
            'success' => true,
            'data' => $trashes
        ]);
    }

    public function show($id)
    {
        $trash = Trash::find($id);
        if ($trash) {
            return response()->json($trash);
        } else {
            return response()->json(['message' => 'Trash not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $trash = Trash::create($request->all());
        return response()->json($trash, 201);
    }

    public function update(Request $request, $id)
    {
        $trash = Trash::find($id);
        if ($trash) {
            $trash->update($request->all());
            return response()->json($trash);
        } else {
            return response()->json(['message' => 'Trash not found'], 404);
        }
    }

    public function destroy($id)
    {
        $trash = Trash::find($id);
        if ($trash) {
            $trash->delete();
            return response()->json(['message' => 'Trash deleted successfully']);
        } else {
            return response()->json(['message' => 'Trash not found'], 404);
        }
    }

    public function selectEmpty()
    {
        $trashes = Trash::where('status', '!=', 'full')->get();
        return response()->json([
            'success' => true,
            'data' => $trashes
        ]);
    }

    public function historyTakeOutTrashes($id)
    {
        $trash = Trash::find($id);
        if ($trash) {
            $historyTakeOutTrashes = $trash->historyTakeOutTrashes;
            return response()->json($historyTakeOutTrashes);
        } else {
            return response()->json(['message' => 'Trash not found'], 404);
        }
    }

    public function createTrashSchedule(Request $request)
    {
        $trashSchedule = TrashSchedule::create($request->all());
        return response()->json($trashSchedule, 201);
    }

    public function addDetailTrashSchedule(Request $request)
    {
        $detailTrashSchedule = DetailTrashSchedule::create($request->all());
        return response()->json($detailTrashSchedule, 201);
    }

    public function getTrashSchedules()
    {
        $trashSchedules = TrashSchedule::with(['petugas', 'admin', 'detailTrashSchedules.trash'])->get();
        return response()->json($trashSchedules);
    }

    public function getTrashScheduleByIdPetugas($id)
    {
        $trashSchedules = TrashSchedule::with(['petugas', 'admin', 'detailTrashSchedules' => function ($query) {
            $query->whereHas('trash', function ($q) {
                $q->where('status', '!=', 'empty');
            })->with('trash');
        }])
            ->where('idPetugas', $id)
            ->where('status', 'scheduled')
            ->get();


        return response()->json([
            "success" => true,
            "data" => $trashSchedules
        ]);
    }

    public function cleanTrash($id)
    {
        $trash = Trash::find($id);
        if ($trash) {
            $trash->status = 'empty';
            $trash->save();
            return response()->json(['success' => true, 'message' => 'Trash cleaned successfully', 'trash' => $trash]);
        } else {
            return response()->json(['success' => false, 'message' => 'Trash not found'], 404);
        }
    }

    public function completeTrashSchedule($id)
    {
        $trashSchedule = TrashSchedule::find($id);
        if ($trashSchedule) {
            $trashSchedule->status = 'completed';
            $trashSchedule->save();
            return response()->json(['success' => true, 'message' => 'Trash schedule completed successfully', 'trashSchedule' => $trashSchedule]);
        } else {
            return response()->json(['success' => false, 'message' => 'Trash schedule not found'], 404);
        }
    }
}
