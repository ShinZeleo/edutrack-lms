<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function generate(Course $course)
    {
        $user = Auth::user();

        if (!$user->isStudent()) {
            abort(403, 'Only students can generate certificates.');
        }

        $isEnrolled = $course->students()->where('users.id', $user->id)->exists();
        if (!$isEnrolled) {
            return redirect()->back()->with('error', 'Anda harus terdaftar di kursus ini untuk mendapatkan sertifikat.');
        }

        $progress = $course->getProgressForUser($user);
        if ($progress < 100) {
            return redirect()->back()->with('error', 'Anda harus menyelesaikan semua lesson untuk mendapatkan sertifikat.');
        }

        $certificate = Certificate::firstOrCreate(
            [
                'student_id' => $user->id,
                'course_id' => $course->id,
            ],
            [
                'certificate_number' => 'CERT-' . strtoupper(uniqid()),
                'issued_at' => now(),
            ]
        );

        return $this->download($certificate);
    }

    public function download(Certificate $certificate)
    {
        $user = Auth::user();

        if (!$user->isStudent() || $certificate->student_id !== $user->id) {
            if (!$user->isAdmin() && !($user->isTeacher() && $certificate->course->teacher_id === $user->id)) {
                abort(403, 'Unauthorized access to certificate.');
            }
        }

        $certificate->load(['student', 'course', 'course.teacher']);

        $data = [
            'studentName' => $certificate->student->name,
            'courseTitle' => $certificate->course->name,
            'date' => $certificate->issued_at->format('F d, Y'),
            'instructor' => $certificate->course->teacher->name,
            'certificateNumber' => $certificate->certificate_number,
        ];

        $pdf = Pdf::loadView('certificates.pdf', $data);

        return $pdf->download('certificate-' . $certificate->course->name . '-' . $certificate->student->name . '.pdf');
    }

    public function view(Certificate $certificate)
    {
        $user = Auth::user();

        if (!$user->isStudent() || $certificate->student_id !== $user->id) {
            if (!$user->isAdmin() && !($user->isTeacher() && $certificate->course->teacher_id === $user->id)) {
                abort(403, 'Unauthorized access to certificate.');
            }
        }

        $certificate->load(['student', 'course', 'course.teacher']);

        $data = [
            'studentName' => $certificate->student->name,
            'courseTitle' => $certificate->course->name,
            'date' => $certificate->issued_at->format('F d, Y'),
            'instructor' => $certificate->course->teacher->name,
            'certificateNumber' => $certificate->certificate_number,
        ];

        $pdf = Pdf::loadView('certificates.pdf', $data);

        return $pdf->stream('certificate-' . $certificate->certificate_number . '.pdf');
    }
}
