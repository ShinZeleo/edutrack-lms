<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $courseTitle }}</title>
    <style>
        @page {
            size: 297mm 210mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #FFFCF5;
            font-family: 'Helvetica', 'Arial', sans-serif;
            -webkit-print-color-adjust: exact;
        }

        .border-left { position: absolute; top: 0; bottom: 0; left: 0; width: 25px; background-color: #E76F51; z-index: 1; }
        .border-top { position: absolute; top: 0; left: 0; right: 0; height: 15px; background-color: #E76F51; z-index: 1; }
        .border-right { position: absolute; top: 0; bottom: 0; right: 0; width: 5px; background-color: #264653; z-index: 1; }
        .border-bottom { position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background-color: #264653; z-index: 1; }

        .inner-frame {
            position: absolute; top: 25px; left: 40px; right: 15px; bottom: 15px;
            border: 2px solid #2A9D8F; background-color: #fff; z-index: 2;
        }

        .inner-line {
            position: absolute; top: 32px; left: 47px; right: 22px; bottom: 22px;
            border: 1px solid #A8DADC; z-index: 3; pointer-events: none;
        }

        .container {
            position: absolute; top: 32px; left: 47px; right: 22px; bottom: 22px;
            z-index: 4; display: flex; flex-direction: column;
            text-align: center; justify-content: space-between; padding: 40px 50px;
        }

        .header-logo {
            font-size: 13px; letter-spacing: 3px; color: #E76F51;
            font-weight: bold; text-transform: uppercase; margin-bottom: 10px;
        }

        .title {
            font-family: 'Georgia', serif; font-size: 46px; color: #264653;
            text-transform: uppercase; letter-spacing: 4px; margin-top: 0;
            margin-bottom: 5px; border-bottom: 1px solid #eee; display: inline-block;
            padding-bottom: 15px; width: 80%; margin-left: auto; margin-right: auto;
        }

        .subtitle {
            margin-top: 15px; font-size: 15px; color: #666;
            font-style: italic; font-family: 'Georgia', serif;
        }

        .student-name {
            font-family: 'Georgia', serif; font-size: 48px; font-weight: 700;
            color: #2A9D8F; margin: 20px 0 5px 0; text-transform: capitalize;
        }

        .ornament { font-size: 20px; color: #E76F51; margin-bottom: 10px; }

        .description { font-size: 16px; color: #555; margin-bottom: 5px; }

        .course-title {
            font-size: 28px; font-weight: bold; color: #264653;
            font-family: 'Helvetica', sans-serif; text-transform: uppercase;
            letter-spacing: 1px; margin: 10px 0 15px 0;
        }

        .footer-quote {
            font-size: 13px; color: #888; font-style: italic; margin-bottom: 20px;
        }

        .bottom-section { width: 100%; margin-top: auto; }

        .date-box {
            display: inline-block; border: 1px solid #2A9D8F; padding: 8px 20px;
            border-radius: 20px; font-size: 12px; color: #2A9D8F; font-weight: bold;
            background: #f0fdfc; margin-bottom: 40px;
        }

        .sign-table { width: 100%; border-collapse: collapse; min-height: 120px; }

        .sign-cell { width: 40%; vertical-align: bottom; text-align: left; }
        .sign-cell.right { text-align: right; }

        .sign-line-box {
            display: inline-block; width: 200px; text-align: left; position: relative;
        }

        .signature-img {
            height: 50px; width: auto; display: block;
            margin-bottom: -10px; margin-left: 10px;
            position: relative; z-index: 10;
        }

        .sign-line {
            border-top: 1px solid #ccc; margin-bottom: 8px; width: 100%;
            position: relative; z-index: 5;
        }

        .sign-name { font-weight: bold; color: #333; font-size: 14px; display: block; }
        .sign-role {
            font-size: 11px; color: #E76F51; text-transform: uppercase;
            letter-spacing: 1px; display: block;
        }

        .cert-id {
            position: absolute; bottom: -8px; right: 0;
            font-size: 9px; color: #aaa; font-family: monospace;
        }
    </style>
</head>
<body>

    <div class="border-left"></div>
    <div class="border-top"></div>
    <div class="border-right"></div>
    <div class="border-bottom"></div>
    <div class="inner-frame"></div>
    <div class="inner-line"></div>

    <div class="container">
        <div>
            <div class="header-logo">{{ config('app.name') }}</div>
            <div class="title">Certificate of Completion</div>
            <div class="subtitle">This certificate is proudly presented to</div>
        </div>

        <div>
            <div class="student-name">{{ $studentName }}</div>
            <div class="ornament">&bull; &bull; &bull;</div>
            <div class="description">for the successful completion of the course</div>
            <div class="course-title">{{ $courseTitle }}</div>
            <div class="footer-quote">"Demonstrating exceptional dedication and commitment to learning."</div>
        </div>

        <div class="bottom-section">
            <div class="date-box">Issued on {{ $date }}</div>

            <table class="sign-table">
                <tr>
                    <td class="sign-cell">
                        <div class="sign-line-box">
                            <img src="{{ public_path('images/signature1.png') }}" class="signature-img" alt="Instructor Signature">

                            <div class="sign-line"></div>
                            <span class="sign-name">{{ $instructor }}</span>
                            <span class="sign-role">Instructor</span>
                        </div>
                    </td>

                    <td class="sign-cell" style="width: 20%;"></td>

                    <td class="sign-cell right">
                        <div class="sign-line-box">
                             <img src="{{ public_path('images/signature2.png') }}" class="signature-img" alt="Director Signature">

                            <div class="sign-line"></div>
                            <span class="sign-name">{{ config('app.name') }} Team</span>
                            <span class="sign-role">Program Director</span>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="cert-id">Serial No: {{ $certificateNumber }}</div>
        </div>

    </div>

</body>
</html>