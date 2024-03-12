<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Vacation;
use Illuminate\Support\Facades\Validator;

class VacationController extends Controller
{
    public function index()
    {
        return Vacation::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            Vacation::create($request->all());

            return response()->json(["message" => "Vacation created!"], 200);
        }
    }

    public function show($id)
    {
        $vacation = Vacation::find($id);

        if ($vacation == null) {
            return response()->json(["message" => "Vacation not found!"], 404);
        } else {
            return Vacation::findOrFail($id);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $vacation = Vacation::findOrFail($id);

            if ($vacation == null) {
                return response()->json(['message'=> 'Vacation not found!'], 404);
            }
            $vacation->update($request->all());
            return response()->json(["message" => "Vacation updated!"], 404);
        }
    }

    public function destroy($id)
    {
        $vacation = Vacation::find($id);

        if ($vacation == null) {
            return response()->json(["message" => "Vacation not found!"], 404);
        } else {
            Vacation::findOrFail($id)->delete();
            return response()->json(["message"=> "Vacation deleted!"], 200);
        }
    }

    public function generatePDF($id)
    {
        $vacation = Vacation::findOrFail($id);

        if ($vacation == null) {
            return response()->json(["message" => "Vacation not found!"], 404);
        } else {
            $html = '<!DOCTYPE html>';
            $html .= '<html>';
            $html .= '<head>';
            $html .= '<title>Holiday Plan</title>';
            $html .= '</head>';
            $html .= '<body>';
            $html .= '<h1>' . $vacation->title . '</h1>';
            $html .= '<p><strong>Description:</strong> ' . $vacation->description . '</p>';
            $html .= '<p><strong>Date:</strong> ' . $vacation->date . '</p>';
            $html .= '<p><strong>Location:</strong> ' . $vacation->location . '</p>';
            $html .= '</body>';
            $html .= '</html>';

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHtml($html);

            return $pdf->download('vacation_pdf.pdf');
        }
    }
}
