@extends('layouts.app')
 
@section('title', 'Patient Records')
 
@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h5 class="fw-semibold mb-0">Patient Records</h5>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPatientModal">
        <i class="bi bi-plus-lg me-1"></i> Add Patient
    </button>
</div>
 
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Blood Type</th>
                    <th>Diagnosis</th>
                    <th>Doctor</th>
                    <th>Date of Visit</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $index => $patient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->blood_type }}</td>
                    <td>{{ $patient->diagnosis }}</td>
                    <td>{{ $patient->doctor }}</td>
                    <td>{{ \Carbon\Carbon::parse($patient->date_of_visit)->format('M d, Y') }}</td>
                    <td>
                        @if($patient->status == 'Admitted')
                            <span class="badge bg-danger">Admitted</span>
                        @elseif($patient->status == 'Outpatient')
                            <span class="badge bg-warning text-dark">Outpatient</span>
                        @else
                            <span class="badge bg-success">Discharged</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-warning"
                            style="width:32px; height:32px; padding:0;"
                            title="Edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editPatientModal"
                            data-id="{{ $patient->id }}"
                            data-name="{{ $patient->name }}"
                            data-age="{{ $patient->age }}"
                            data-gender="{{ $patient->gender }}"
                            data-blood="{{ $patient->blood_type }}"
                            data-contact="{{ $patient->contact }}"
                            data-address="{{ $patient->address }}"
                            data-diagnosis="{{ $patient->diagnosis }}"
                            data-doctor="{{ $patient->doctor }}"
                            data-date="{{ $patient->date_of_visit }}"
                            data-status="{{ $patient->status }}">
                            <i class="bi bi-pencil-fill" style="font-size:13px;"></i>
                        </button>
                        <button class="btn btn-sm btn-danger"
                            style="width:32px; height:32px; padding:0;"
                            title="Delete"
                            onclick="confirmDeletePatient('{{ route('patients.destroy', $patient->id) }}')">
                            <i class="bi bi-trash-fill" style="font-size:13px;"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">No patient records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
 
<!-- ADD PATIENT MODAL -->
<div class="modal fade" id="addPatientModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-semibold">Add Patient</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Age</label>
                            <input type="number" name="age" class="form-control" min="0" max="120" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Blood Type</label>
                            <select name="blood_type" class="form-select">
                                <option value="">Select</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>O+</option><option>O-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-size:13px">Contact Number</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label" style="font-size:13px">Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Diagnosis</label>
                            <input type="text" name="diagnosis" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Doctor Assigned</label>
                            <input type="text" name="doctor" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Date of Visit</label>
                            <input type="date" name="date_of_visit" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Admitted">Admitted</option>
                                <option value="Outpatient">Outpatient</option>
                                <option value="Discharged">Discharged</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<!-- EDIT PATIENT MODAL -->
<div class="modal fade" id="editPatientModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-semibold">Edit Patient</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPatientForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Full Name</label>
                            <input type="text" name="name" id="eName" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Age</label>
                            <input type="number" name="age" id="eAge" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Gender</label>
                            <select name="gender" id="eGender" class="form-select" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px">Blood Type</label>
                            <select name="blood_type" id="eBlood" class="form-select">
                                <option value="">Select</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>O+</option><option>O-</option>
                                <option>AB+</option><option>AB-</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-size:13px">Contact Number</label>
                            <input type="text" name="contact" id="eContact" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label" style="font-size:13px">Address</label>
                            <input type="text" name="address" id="eAddress" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Diagnosis</label>
                            <input type="text" name="diagnosis" id="eDiagnosis" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Doctor Assigned</label>
                            <input type="text" name="doctor" id="eDoctor" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Date of Visit</label>
                            <input type="date" name="date_of_visit" id="eDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:13px">Status</label>
                            <select name="status" id="eStatus" class="form-select" required>
                                <option value="Admitted">Admitted</option>
                                <option value="Outpatient">Outpatient</option>
                                <option value="Discharged">Discharged</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<!-- DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deletePatientModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content border-0 shadow" style="background:#fff; border-radius:12px;">
            <div class="modal-body text-center py-4 px-4">
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width:60px; height:60px; background:#fff0f0;">
                        <i class="bi bi-trash-fill text-danger" style="font-size:26px;"></i>
                    </div>
                </div>
                <h6 class="fw-semibold mb-1">Delete Patient</h6>
                <p class="text-muted mb-0" style="font-size:13px;">Are you sure you want to delete this patient? This action cannot be undone.</p>
            </div>
            <div class="modal-footer justify-content-center border-0 pb-4 pt-0 gap-2">
                <button type="button" class="btn btn-sm px-4"
                    style="background:#0d9488; color:#fff; border:none; border-radius:6px;"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm px-4"
                    style="border-radius:6px;"
                    id="confirmDeletePatientBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
 
<!-- Hidden Delete Form -->
<form id="deletePatientForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
 
@endsection
 
@push('scripts')
<script>
    function confirmDeletePatient(actionUrl) {
        document.getElementById('deletePatientForm').action = actionUrl;
        new bootstrap.Modal(document.getElementById('deletePatientModal')).show();
    }
 
    document.getElementById('confirmDeletePatientBtn').addEventListener('click', function () {
        document.getElementById('deletePatientForm').submit();
    });
 
    const editPatientModal = document.getElementById('editPatientModal');
    editPatientModal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;
        document.getElementById('eName').value      = btn.getAttribute('data-name');
        document.getElementById('eAge').value       = btn.getAttribute('data-age');
        document.getElementById('eGender').value    = btn.getAttribute('data-gender');
        document.getElementById('eBlood').value     = btn.getAttribute('data-blood');
        document.getElementById('eContact').value   = btn.getAttribute('data-contact');
        document.getElementById('eAddress').value   = btn.getAttribute('data-address');
        document.getElementById('eDiagnosis').value = btn.getAttribute('data-diagnosis');
        document.getElementById('eDoctor').value    = btn.getAttribute('data-doctor');
        document.getElementById('eDate').value      = btn.getAttribute('data-date');
        document.getElementById('eStatus').value    = btn.getAttribute('data-status');
        document.getElementById('editPatientForm').action = '/patients/' + btn.getAttribute('data-id');
    });
</script>
@endpush