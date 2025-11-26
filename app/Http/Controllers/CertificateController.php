<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        try {
            $certificate = DB::transaction(function () use ($user, $course) {
                return Certificate::firstOrCreate(
                    [
                        'student_id' => $user->id,
                        'course_id' => $course->id,
                    ],
                    [
                        'certificate_number' => 'CERT-' . strtoupper(uniqid()),
                        'issued_at' => now(),
                    ]
                );
            });

            return $this->download($certificate);
        } catch (\Exception $e) {
            Log::error('Error generating certificate', [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat sertifikat. Silakan coba lagi.');
        }
    }

    public function download(Certificate $certificate)
    {
        $user = Auth::user();

        if (!$user->isStudent() || $certificate->student_id !== $user->id) {
            if (!$user->isAdmin() && !($user->isTeacher() && $certificate->course->teacher_id === $user->id)) {
                abort(403, 'Unauthorized access to certificate.');
            }
        }

        try {
            $certificate->load(['student', 'course', 'course.teacher']);

            $data = [
                'studentName' => $certificate->student->name,
                'courseTitle' => $certificate->course->name,
                'date' => $certificate->issued_at->format('F d, Y'),
                'instructor' => $certificate->course->teacher->name,
                'certificateNumber' => $certificate->certificate_number,
            ];

            $pdf = Pdf::loadView('certificates.pdf', $data);

            // Sanitize filename: remove invalid characters for file names
            $courseName = preg_replace('/[\/\\\\:*?"<>|]/', '-', $certificate->course->name);
            $studentName = preg_replace('/[\/\\\\:*?"<>|]/', '-', $certificate->student->name);
            $filename = 'certificate-' . $courseName . '-' . $studentName . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            Log::error('Error downloading certificate', [
                'certificate_id' => $certificate->id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh sertifikat. Silakan coba lagi.');
        }
    }

    public function view(Certificate $certificate)
    {
        $user = Auth::user();

        if (!$user->isStudent() || $certificate->student_id !== $user->id) {
            if (!$user->isAdmin() && !($user->isTeacher() && $certificate->course->teacher_id === $user->id)) {
                abort(403, 'Unauthorized access to certificate.');
            }
        }

        try {
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
        } catch (\Exception $e) {
            Log::error('Error viewing certificate', [
                'certificate_id' => $certificate->id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan sertifikat. Silakan coba lagi.');
        }
    }
}
