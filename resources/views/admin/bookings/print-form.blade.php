<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Form - {{ $gym->name ?? 'GymCenter' }}</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                line-height: 1.4;
                color: #000;
                padding: 20px;
            }
            
            @media print {
                body {
                    padding: 0;
                }
                
                .no-print {
                    display: none !important;
                }
                
                .page-break {
                    page-break-after: always;
                }
            }
            
            .form-header {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #000;
                padding-bottom: 15px;
            }
            
            .form-header h1 {
                font-size: 24px;
                margin-bottom: 5px;
            }
            
            .form-header p {
                font-size: 14px;
                color: #666;
            }
            
            .section {
                margin-bottom: 20px;
            }
            
            .section-title {
                font-size: 14px;
                font-weight: bold;
                border-bottom: 1px solid #ccc;
                padding-bottom: 5px;
                margin-bottom: 10px;
                text-transform: uppercase;
            }
            
            .form-row {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 10px;
            }
            
            .form-group {
                flex: 1;
                min-width: 150px;
            }
            
            .form-group.full-width {
                flex: 100%;
            }
            
            .form-group label {
                display: block;
                font-weight: bold;
                margin-bottom: 3px;
                font-size: 11px;
            }
            
            .form-group .field {
                border-bottom: 1px solid #000;
                min-height: 25px;
                padding: 5px 0;
            }
            
            .checkbox-group {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }
            
            .checkbox-item {
                display: flex;
                align-items: center;
                gap: 5px;
            }
            
            .checkbox-item .box {
                width: 15px;
                height: 15px;
                border: 1px solid #000;
            }
            
            .checkbox-item label {
                font-weight: normal;
            }
            
            .signature-section {
                margin-top: 40px;
                display: flex;
                justify-content: space-between;
            }
            
            .signature-box {
                width: 45%;
            }
            
            .signature-box .line {
                border-bottom: 1px solid #000;
                margin-top: 40px;
                margin-bottom: 5px;
            }
            
            .print-btn {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 10px 20px;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
            }
            
            .print-btn:hover {
                background: #0056b3;
            }
            
            .footer-note {
                margin-top: 30px;
                font-size: 10px;
                color: #666;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <button class="print-btn no-print" onclick="window.print()">Print Form</button>
        
        <div class="form-header">
            <h1>{{ $gym->name ?? 'GymCenter' }}</h1>
            @if($gym->address ?? false)
                <p>{{ $gym->address }}</p>
            @endif
            @if($gym->phone ?? false)
                <p>Phone: {{ $gym->phone }}</p>
            @endif
            <h2 style="margin-top: 15px;">Member Registration Form</h2>
        </div>
        
        <!-- Personal Information -->
        <div class="section">
            <div class="section-title">Personal Information</div>
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <div class="field"></div>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <div class="field"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="field"></div>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <div class="field"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Email Address</label>
                    <div class="field"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Address</label>
                    <div class="field"></div>
                </div>
            </div>
        </div>
        
        <!-- Emergency Contact -->
        <div class="section">
            <div class="section-title">Emergency Contact</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Contact Name</label>
                    <div class="field"></div>
                </div>
                <div class="form-group">
                    <label>Contact Phone</label>
                    <div class="field"></div>
                </div>
            </div>
        </div>
        
        <!-- Membership Information -->
        <div class="section">
            <div class="section-title">Membership Information</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Membership Type</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <div class="box"></div>
                            <label>Monthly</label>
                        </div>
                        <div class="checkbox-item">
                            <div class="box"></div>
                            <label>Yearly</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <div class="field"></div>
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <div class="field"></div>
                </div>
            </div>
        </div>
        
        <!-- Health Information -->
        <div class="section">
            <div class="section-title">Health Information</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Weight (kg)</label>
                    <div class="field"></div>
                </div>
                <div class="form-group">
                    <label>Height (cm)</label>
                    <div class="field"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Do you have any health conditions? If yes, please list:</label>
                    <div class="field" style="height: 40px;"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Do you have any allergies? If yes, please list:</label>
                    <div class="field" style="height: 40px;"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Are you currently taking any medications? If yes, please list:</label>
                    <div class="field" style="height: 40px;"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Do you have any injuries? If yes, please provide details:</label>
                    <div class="field" style="height: 40px;"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label>What are your fitness goals?</label>
                    <div class="field" style="height: 40px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Agreement -->
        <div class="section">
            <div class="section-title">Agreement</div>
            <div class="checkbox-group" style="flex-direction: column; gap: 10px;">
                <div class="checkbox-item">
                    <div class="box"></div>
                    <label>I confirm that the information provided above is accurate and complete.</label>
                </div>
                <div class="checkbox-item">
                    <div class="box"></div>
                    <label>I understand that I must inform the gym of any changes to my health condition.</label>
                </div>
                <div class="checkbox-item">
                    <div class="box"></div>
                    <label>I have read and agree to the terms and conditions and privacy policy.</label>
                </div>
            </div>
        </div>
        
        <!-- Signatures -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="line"></div>
                <p>Member Signature</p>
            </div>
            <div class="signature-box">
                <div class="line"></div>
                <p>Staff Signature</p>
            </div>
        </div>
        
        <div class="footer-note">
            <p>Form generated on {{ now()->format('F d, Y') }}</p>
        </div>
    </body>
</html>
