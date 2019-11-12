<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><title>Vendor Management {{ $vendor->vendor_name  }}</title>
        <link rel="stylesheet" href="{{ public_path('theme/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ storage_path ('pdf.css') }}">
    </head>
    <style media="screen">
        body, table  {
            font-size: 8pt;
        }
    </style>
    <body>
          <script type="text/php">
              if (isset($pdf)) {
                  $text = "{PAGE_NUM} of {PAGE_COUNT}" ;
                  $size = 7;
                  $font = $fontMetrics->getFont("Myriad");
                  $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                  $x = ($pdf->get_width() - $width);
                  $y = $pdf->get_height() - 35;
                  $pdf->page_text($x, $y, $text, $font, $size );
                  $pdf->page_text(20, $y, "Form No. GMF/Q-039 R3" , $font, $size );
              }
          </script>
        <?php
            $type_busines = json_decode($vendor->type_bussines, true) ;
            $document_evidence = json_decode($vendor->document_evidence, true) ;
            $other_document_evidence_value = json_decode($vendor->other_document_evidence_value, true) ;
        ?>
        <table style="width:100%">
            <tr>
                <td><img src="{{ public_path('images/gmf.png') }}" width="200"></td>
                <td>
                    <!-- take from website data -->
                    Quality Assurance Departement. <br>
                    GMF Aero Asia, Seokarno-Hatta International Airport <br>
                    Cengkareng-Indonesia, P.O.Box 1303 -  BUSH 19130 <br>
                    Phone. (021)5508080, Fax, 62-21-5501639 <br>
                 </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <br>
                    <strong style="font-size : 14pt">VENDOR APPROVAL QUESTIONNAIRE</strong>
                    <br>
                </td>
            </tr>
        </table>
        Respondent Company
        <table style="width:100%">
            <tr>
                <td>Name </td>
                <td>: {{ ucwords($vendor->vendor_name) }}</td>
            </tr>
            <tr>
                <td>Street</td>
                <td >: {{ ucwords($vendor->vendor_address) }}</td>
            </tr>
            <tr>
                <td>PO BOX</td>
                <td>: </td>
            </tr>
            <tr>
                <td>City </td>
                <td>
                    <table style="width:70%">
                        <tr>
                            <td style="width:150px">: {{ ucwords($vendor->vendor_city)}} </td>
                            <td style="width:50px">State</td>
                            <td style="width:100px">: {{ ucwords($vendor->vendor_state) }}</td>
                            <td style="width:50px">ZIP</td>
                            <td style="width:100px">: {{ ucwords($vendor->vendor_zip_code) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Telephone </td>
                <td>
                    <table>
                        <tr>
                            <td style="width:150px">: {{ $vendor->vendor_phone  }} </td>
                            <td style="width:50px">Fax</td>
                            <td style="width:100px">: {{ $vendor->vendor_fax }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Primary Contact</td>
                <td>: {{ ucwords($vendor->contact_name) }}</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>: {{ ucwords($vendor->contact_title) }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ ucwords($vendor->contact_email) }}</td>
            </tr>
        </table>

        <br>

        <table style="width:100%">
            <tr>
                <td>A. </td>
                <td>Quality Assurance Evaluation</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table style="width: 100%">
                        <tr>
                            <td valign="top" style="width: 20px;">1. </td>
                            <td>
                                <table style="width:100%;">
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Airline'])) @if($type_busines['Airline'] == true) Checked @endif @endif> Airline </td>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Supplier'])) @if($type_busines['Supplier'] == true) Checked @endif  @endif> Supplier </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Certificate Repair Station'])) @if($type_busines['Certificate Repair Station'] == true) Checked @endif @endif > Certificate Repair Station </td>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Machine Welding'])) @if($type_busines['Machine Welding'] == true) Checked @endif  @endif> Machine / Welding </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Original Equipment Manufacturer'])) @if($type_busines['Original Equipment Manufacturer'] == true) Checked @endif  @endif> Original Equipment Manufacturer </td>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Fabricator'])) @if($type_busines['Fabricator'] == true) Checked @endif  @endif> Fabricator </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Plating / Special Process'])) @if($type_busines['Plating / Special Process'] == true) Checked @endif  @endif> Plating / Special process </td>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Calibration Lab'])) @if($type_busines['Calibration Lab'] == true) Checked @endif  @endif> Calibration Lab </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Accessory / Repair'])) @if($type_busines['Accessory / Repair'] == true) Checked @endif  @endif> Accessory Repair </td>
                                        <td> <input type="checkbox" @if(!empty($type_busines['GSE'])) @if($type_busines['GSE'] == true) Checked @endif  @endif> GSE </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['NDI / NDT'])) @if($type_busines['NDI / NDT'] == true) Checked @endif  @endif> NDI / NDT  </td>
                                        <td>
                                            <input type="checkbox" @if(!empty($type_busines['Others'])) @if($type_busines['Others'] == true) Checked @endif  @endif> Others
                                            @if(!empty($type_busines['Others'])) @if($type_busines['Others'] == true) : {{ $type_busines['Other Value'] }} @endif  @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="checkbox" @if(!empty($type_busines['Distibutor'])) @if($type_busines['Distibutor'] == true) Checked @endif  @endif> Distibutor </td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">2. </td>
                            <td>
                                <table>
                                    <tr>
                                        <td style="width: 220px;">Age of Organization</td>
                                        <td>: {{ ucwords($vendor->age_organization) }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">3. </td>
                            <td>
                                <table>
                                    <tr>
                                        <td style="width: 220px;">Total Number of Employee</td>
                                        <td>: {{ $vendor->total_employee }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Number of Supervisors</td>
                                        <td>: {{ $vendor->total_supervisors }} </td>
                                    </tr>
                                    <tr>
                                        <td>Total Number of Inspectors</td>
                                        <td>: {{ $vendor->total_inspectors }} </td>
                                    </tr>
                                    <tr>
                                        <td>Total Number of Production Personel</td>
                                        <td>: {{ $vendor->total_personel }} </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">4.</td>
                            <td>
                                 Name, Designation, and Stamp of Approval signatories on approved certificate or certificate
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Name </td>
                                            <td>Designation </td>
                                            <td>Stamp </td>
                                        </tr>
                                    </thead>
                                    @foreach( json_decode($vendor->list_name_aproval, true) as $c )
                                        <tr>
                                            <td>{{ ucwords($c['name']) }}</td>
                                            <td>{{ ucwords($c['designation']) }}</td>
                                            <td></td>
                                        </tr>
                                    @endForeach
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%">
            <tr>
                <td style="width:15px;"></td>
                <td valign="top" style="width: 20px;">5. </td>
                <td>
                    <table style="width:100%;" >
                        <tr>
                            <td valign="top"  style="width: 220px;">List of Customer </td>
                            <td>
                                <div style="width:80%">
                                    <div class="row">
                                        @php $no = 1 @endphp
                                        @foreach( json_decode($vendor->list_customers, true) as $c )
                                            <div class="col-xs-6 ">
                                                <div class="border-list-customer">
                                                    {{ ucwords($c['name_customer']) }}
                                                </div>
                                            </div>
                                            @if($no%2 == 0)
                                                <br>
                                                <br>
                                            @endif

                                            @php $no++ @endphp

                                        @endForeach
                                    </div>

                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:15px;"></td>
                <td valign="top">6.</td>
                <td>
                    <table style="width:100%;"  style="width: 220px;" >
                        <tr>
                            <td valign="top">List of Current Capability </td>
                            <td>
                              <!-- {{ ucwords($vendor->list_curent_capability	) }} -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:15px;"></td>
                <td valign="top">7.</td>
                <td>
                    Representative in Indonesia :<br>
                    <div class="border-list-customer">
                      <pre>{{ ucwords($vendor->representative_indonesia) }}
                      </pre>
                    </div>

                </td>
            </tr>
        </table>

        <div class="page_break"></div>
        <table>
            <tr>
                <td style="width:20px">
                    <br>
                    <br>
                    B.
                </td>
                <td>
                  <br>
                  <br>
                    Quality Assurance Evaluation
                </td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <td>No </td>
                <td>Requirements</td>
                <td>Yes</td>
                <td>No </td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>1. </td>
                <td> Is your organization in any way approved by Indonesian DGCA, FAA, EASA, any others National Civil Aviation Authority or International/National Accreditation Body e.g.: LBA, Bureau Verieties, etc.
                    <br>If Yes, Specify
                </td>
                <td class="text-center"> @if($vendor->evaluation_organization == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_organization == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_organization == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>2. </td>
                <td>
                    Do you have a Quality Assurance Program. If yes, is it the form of written Procedure ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_quality_assurance == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_quality_assurance == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_quality_assurance == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>3. </td>
                <td>
                    Is your QA system bases upon military, National, or International Quality system standards ? If applicable, indicate which of the following were in practice.
                    <br>MIL-STD-9858A
                    <br>MIL-I-45206A
                    <br>ASQC-C1 Series(American)
                    <br>Can 3-x 299, Cat. 1 through 4 (Canadian)
                    <br>BS5750, Parts 1 through 4 (British)
                    <br>AS1821, 1822, 1823 (Australian)
                    <br>ISO/DIS 9000 (All levels) (International Standards Organization)
                    <br>ISO/IEC 17025:2005
                    <br>ANSI/NCSL Z540-1:1994
                    <br>AQAP-1,-4,-9(NATO)
                    <br>Others:(specify)
                </td>
                <td class="text-center"> @if($vendor->evaluation_qa_system == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_qa_system == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_qa_system == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>4. </td>
                <td>
                    Indicate your source/s of supply :
                    <br>Original Equipment Manufacturer's (OEM)
                    <br>OEM-Licensed sub-contractors.
                    <br>Alternate source vendors approved by OEM.
                    <br>PMA-Approved sources
                    <br>Sources as defined in Military Qualified
                    <br>Products List (for AN, MS, NAS standards)
                    <br>Surplus Airline Inventory
                    <br>Other industry source
                </td>
                <td class="text-center"> @if($vendor->evaluation_indicate_supply == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_indicate_supply == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_indicate_supply == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>5. </td>
                <td>
                    Are all Part inspected upon receipt ?
                    <br>An reinpected prior to shipment ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_part_inspection == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_part_inspection == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_part_inspection == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>6. </td>
                <td>
                    Do you maintened any quality records or rating on your suppliers ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_maintain_quality == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_maintain_quality == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_maintain_quality == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>7. </td>
                <td>
                    Do you have a program to re-certify your stock of routable and repairable periodically ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_program_recertify == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_program_recertify == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_program_recertify == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>8. </td>
                <td>
                    Do you have shelf life control policies and procedure ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_control_policies == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_control_policies == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_control_policies == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>9. </td>
                <td>
                    Do you maintain trace-ability of all parts ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_trace_ability == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_trace_ability == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_trace_ability == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>10. </td>
                <td>
                    (for suppliers in the USA only)
                    <br>Can you provide a material certification for new parts like the example below
                    <br>All part covered by this document were produced by a manufacturer holding a FAA approved production inspection system issued under FAR 21, sub-part F, or sub-part G
                    <br>there parts were produced by the prima manufacturer. None of these parts have been subjected to reverse stress or heat and unless otherwise stated are new and unused. (or words to that effect)
                </td>
                <td class="text-center"> @if($vendor->evaluation_for_usa_only == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_for_usa_only == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_for_usa_only == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>11. </td>
                <td>
                    can you provide the folowing should need arise ?
                    <br>your Purchase Order, use to acquire the part.
                    <br>Repair Order, if applicable.
                    <br>Part incoming certificate/serviceable tag, or invoice from tour supplier. Factory/Manufacturing Certificate (for fasteners).
                    <br>Any other documents tracing back the birth history of the part.
                </td>
                <td class="text-center"> @if($vendor->evaluation_provide == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_provide == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_provide == 0 ) X @endif</td>
            </tr>
            <tr>
                <td>12. </td>
                <td>
                    Does Your company implement Safety Management System (SMS) ?
                </td>
                <td class="text-center"> @if($vendor->evaluation_implement_sms == 1 ) X @endif  </td>
                <td class="text-center"> @if($vendor->evaluation_implement_sms == 2 ) X @endif</td>
                <td class="text-center"> @if($vendor->evaluation_implement_sms == 0 ) X @endif</td>
            </tr>
        </table>
        <table style="width:100%">
            <tr>
                <td style="width:20px">
                    C.
                </td>
                <td>
                    Document Evidence
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Please a current copy of the following : <br>
                    (Check those applicable and attach list) <br>
                    <table style="width:100%">
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" @if(!empty($document_evidence['DGCA'])) @if($document_evidence['DGCA'] == true) Checked @endif @endif> Indonesia DGCA Certificate <br>
                                <input type="checkbox" @if(!empty($document_evidence['FAA'])) @if($document_evidence['FAA'] == true) Checked @endif @endif> FAA Certificate <br>
                                <input type="checkbox" @if(!empty($document_evidence['EASA'])) @if($document_evidence['EASA'] == true) Checked @endif @endif> EASA Certificate <br>
                                <input type="checkbox" @if(!empty($document_evidence['EASO'])) @if($document_evidence['EASO'] == true) Checked @endif @endif> EASO Certificate <br>
                                <input type="checkbox" @if(!empty($document_evidence['ASA'])) @if($document_evidence['ASA'] == true) Checked @endif @endif> ASA Certificate <br>
                                <input type="checkbox" @if(!empty($document_evidence['Calibration Lab'])) @if($document_evidence['Calibration Lab'] == true) Checked @endif @endif>
                                    Calibration Lab Accreditation Certificate
                                    @if(!empty($document_evidence['KAN']) || !empty($document_evidence['OtherCalibration']) )
                                    (
                                      @if($document_evidence['KAN'] == true) KAN @endif
                                      @if(!empty($document_evidence['OtherCalibration']) && $document_evidence['OtherCalibration'] == true), {{ $document_evidence['OtherCalibration_value'] }}  @endif
                                    )
                                    @endif
                                <br>
                                <input type="checkbox" @if(!empty($document_evidence['OEM'])) @if($document_evidence['OEM'] == true) Checked @endif @endif> OEM <br>
                                <input type="checkbox" @if(!empty($document_evidence['STC / TSOA'])) @if($document_evidence['STC / TSOA'] == true) Checked @endif @endif> STC / TSOA <br>
                                <input type="checkbox" @if(!empty($document_evidence['Current Capability List'])) @if($document_evidence['Current Capability List'] == true) Checked @endif @endif> Curren Capability List <br>
                                <input type="checkbox" @if(!empty($document_evidence['Inspection Procedural Manual'])) @if($document_evidence['Inspection Procedural Manual'] == true) Checked @endif @endif> Inspection Procedural manual/ Exposition Manual /Quality Procedure manual/Quality Manual  <br>
                                <input type="checkbox" @if(!empty($document_evidence['Other'])) @if($document_evidence['Other'] == true) Checked @endif @endif> Others Specify

                                @if(!empty($document_evidence['Other'])) @if($document_evidence['Other'] == true) :
                                  <ul>
                                    @foreach($other_document_evidence_value as $value)
                                        <li>{{ $value['other_value'] }}</li>

                                    @endForeach
                                  </ul>
                                @endif @endif<br>
                                <br>Date of last DGCA / FAA / EASA audit : {{ date('d F Y', strtotime($vendor->date_audit)) }}
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" ><br>***</td>
                            <td><br>Tick ( v ) if Available, otherwise, Cross (X),
                                (Bulky Print may  be  dispatched to us separately. if you so decided, give indicated)
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td></td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="width:170px">Signature</td>
                                        <td>: ................................................................................................................................................ <td>
                                    </tr>
                                    <tr>
                                        <td>Printed name</td>
                                        <td>: ................................................................................................................................................ <td>
                                    </tr>
                                    <tr>
                                        <td>Title</td>
                                        <td>: ..........................................................................................
                                            Date : .......................................... </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

<style media="screen">
  li{
    margin-left:  -25px;
    list-style: none ;
  }

  .page_break{
      page-break-before: always;
  }
</style>
