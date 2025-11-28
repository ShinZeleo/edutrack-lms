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

        /* -- FRAME DEKORASI -- */
        .border-left { position: absolute; top: 0; bottom: 0; left: 0; width: 25px; background-color: #E76F51; z-index: 10; }
        .border-top { position: absolute; top: 0; left: 0; right: 0; height: 15px; background-color: #E76F51; z-index: 10; }
        .border-right { position: absolute; top: 0; bottom: 0; right: 0; width: 5px; background-color: #264653; z-index: 10; }
        .border-bottom { position: absolute; bottom: 0; left: 0; right: 0; height: 5px; background-color: #264653; z-index: 10; }

        .inner-frame {
            position: absolute; top: 25px; left: 40px; right: 15px; bottom: 15px;
            border: 3px double #2A9D8F;
            background-color: #fff; z-index: 1;
        }

        /* -- WATERMARK (Luna bikin lebih soft lagi warnanya) -- */
        .watermark {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px; /* Sedikit dikecilkan biar ga nabrak parah */
            font-weight: bold;
            /* Opacity diturunkan jadi 0.03 biar super samar */
            color: rgba(42, 157, 143, 0.03); 
            z-index: 0;
            white-space: nowrap;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
            pointer-events: none;
            letter-spacing: 10px;
        }

        .container {
            position: absolute; top: 32px; left: 47px; right: 22px; bottom: 22px;
            z-index: 4; display: flex; flex-direction: column;
            text-align: center; justify-content: space-between; padding: 40px 50px;
        }

        /* HEADER */
        .header-logo {
            font-size: 14px; letter-spacing: 5px; color: #E76F51;
            font-weight: bold; text-transform: uppercase; margin-bottom: 5px;
        }

        .title {
            font-family: 'Georgia', serif; font-size: 50px; color: #264653;
            text-transform: uppercase; letter-spacing: 5px; margin-top: 0;
            margin-bottom: 5px; border-bottom: 2px solid #E76F51; display: inline-block;
            padding-bottom: 10px; width: auto; padding-left: 40px; padding-right: 40px;
            line-height: 1.1; /* Jarak antar baris judul diperbaiki */
        }

        .subtitle {
            margin-top: 15px; font-size: 16px; color: #666;
            font-style: italic; font-family: 'Georgia', serif;
        }

        /* KONTEN TENGAH */
        .student-name {
            font-family: 'Georgia', serif; font-size: 52px; font-weight: 700;
            color: #2A9D8F; margin: 20px 0 5px 0; text-transform: capitalize;
            text-shadow: 1px 1px 0px rgba(0,0,0,0.1); 
        }

        /* Fix Simbol Diamond */
        .ornament { 
            font-size: 24px; color: #E76F51; margin-bottom: 15px; letter-spacing: 5px;
            font-family: 'DejaVu Sans', sans-serif; /* Wajib pakai font ini buat simbol */
        }

        .description { font-size: 16px; color: #555; margin-bottom: 5px; letter-spacing: 0.5px; }

        .course-title {
            font-size: 30px; font-weight: 800; color: #264653;
            font-family: 'Helvetica', sans-serif; text-transform: uppercase;
            letter-spacing: 2px; margin: 10px 0 20px 0;
        }

        .footer-quote {
            font-size: 14px; color: #888; font-style: italic; margin-bottom: 10px;
        }

        /* FOOTER & TANDA TANGAN */
        .bottom-section { width: 100%; margin-top: auto; position: relative; }

        .date-box {
            display: inline-block; border: 1px solid #2A9D8F; padding: 8px 30px;
            border-radius: 50px; font-size: 13px; color: #2A9D8F; font-weight: bold;
            background: #fcfcfc; margin-bottom: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .sign-table { width: 100%; border-collapse: collapse; min-height: 120px; }
        .sign-cell { width: 35%; vertical-align: bottom; text-align: left; }
        .sign-cell.right { text-align: right; }
        .sign-center { width: 30%; text-align: center; vertical-align: bottom; }

        .sign-line-box {
            display: inline-block; width: 220px; text-align: left; position: relative;
        }

        /* Image TTD */
        .signature-img {
            height: 60px; width: auto; display: block;
            margin-bottom: -15px; margin-left: 20px;
            position: relative; z-index: 10; opacity: 0.9;
        }

        .sign-line {
            border-top: 1px solid #333; margin-bottom: 8px; width: 100%;
            position: relative; z-index: 5;
        }

        .sign-name { font-weight: bold; color: #333; font-size: 15px; display: block; }
        .sign-role {
            font-size: 11px; color: #E76F51; text-transform: uppercase;
            letter-spacing: 1px; display: block; font-weight: bold;
        }

        /* -- GOLD SEAL -- */
        .seal-container {
            display: inline-block;
            width: 100px; height: 100px; border-radius: 50%;
            border: 3px double #d4af37; padding: 5px;
            position: relative; margin-bottom: 10px;
        }
        
        .seal-inner {
            width: 100%; height: 100%; border-radius: 50%; 
            border: 1px dashed #d4af37; display: flex;
            align-items: center; justify-content: center;
            flex-direction: column; color: #d4af37;
        }

        .seal-text { font-size: 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Fix Simbol Bintang */
        .seal-icon { 
            font-size: 24px; margin: 2px 0; 
            font-family: 'DejaVu Sans', sans-serif; /* Wajib pakai font ini buat simbol */
        }

        .cert-id {
            position: absolute; bottom: -10px; right: 0;
            font-size: 10px; color: #aaa; font-family: monospace; letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="border-left"></div>
    <div class="border-top"></div>
    <div class="border-right"></div>
    <div class="border-bottom"></div>
    
    <div class="inner-frame">
        <div class="watermark">OFFICIAL DOCUMENT</div>
    </div>
    
    <div class="inner-line"></div>

    <div class="container">
        <div>
            <div class="header-logo">{{ config('app.name') }}</div>
            <div class="title">Certificate of <br> Completion</div>
            <div class="subtitle">This certifies that the following individual has successfully met all requirements</div>
        </div>

        <div>
            <div class="student-name">{{ $studentName }}</div>
            <div class="ornament">♦ ♦ ♦</div>
            
            <div class="description">Has demonstrated excellence and dedication in mastering</div>
            <div class="course-title">{{ $courseTitle }}</div>
            <div class="footer-quote">"Knowledge is the gateway to opportunity."</div>
        </div>

        <div class="bottom-section">
            <div class="date-box">Awarded on {{ $date }}</div>

            <table class="sign-table">
                <tr>
                    <td class="sign-cell">
                        <div class="sign-line-box">
                            <img src="{{ public_path('images/signature1.png') }}" class="signature-img" alt="Sign">
                            <div class="sign-line"></div>
                            <span class="sign-name">{{ $instructor }}</span>
                            <span class="sign-role">Head Instructor</span>
                        </div>
                    </td>

                    <td class="sign-center">
                        <div class="seal-container">
                            <div class="seal-inner">
                                <div class="seal-text">Verified</div>
                                <div class="seal-icon">★</div>
                                <div class="seal-text">Certification</div>
                            </div>
                        </div>
                    </td>

                    <td class="sign-cell right">
                        <div class="sign-line-box">
                             <img src="{{ public_path('images/signature2.png') }}" class="signature-img" alt="Sign">
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