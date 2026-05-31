<?php
 
namespace App\Http\Controllers;
 
use App\Models\Patient;
use Illuminate\Http\Request;
 
class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where('user_id', auth()->id())->latest()->get();
        return view('patients.index', compact('patients'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'age'           => 'required|integer|min:0|max:120',
            'gender'        => 'required|in:Male,Female',
            'blood_type'    => 'nullable|string',
            'contact'       => 'nullable|string',
            'address'       => 'nullable|string',
            'diagnosis'     => 'required|string',
            'doctor'        => 'nullable|string',
            'date_of_visit' => 'required|date',
            'status'        => 'required|in:Admitted,Outpatient,Discharged',
        ]);
 
        Patient::create([
            'user_id'       => auth()->id(),
            'name'          => $request->name,
            'age'           => $request->age,
            'gender'        => $request->gender,
            'blood_type'    => $request->blood_type,
            'contact'       => $request->contact,
            'address'       => $request->address,
            'diagnosis'     => $request->diagnosis,
            'doctor'        => $request->doctor,
            'date_of_visit' => $request->date_of_visit,
            'status'        => $request->status,
        ]);
 
        return redirect()->route('patients.index')->with('success', 'Patient added successfully!');
    }
 
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'age'           => 'required|integer|min:0|max:120',
            'gender'        => 'required|in:Male,Female',
            'blood_type'    => 'nullable|string',
            'contact'       => 'nullable|string',
            'address'       => 'nullable|string',
            'diagnosis'     => 'required|string',
            'doctor'        => 'nullable|string',
            'date_of_visit' => 'required|date',
            'status'        => 'required|in:Admitted,Outpatient,Discharged',
        ]);
 
        $patient->update($request->all());
 
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }
 
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully!');
    }
}