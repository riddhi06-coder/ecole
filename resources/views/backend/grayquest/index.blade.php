<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')

    <style>
        /* ============================================================
           GrayQuest Fees — scoped styles (.fees-page)
           Same design system as Student Fees page
        ============================================================ */

        .fees-page {
            --fee-ink:     #14232b;
            --fee-body:    #3d4f5c;
            --fee-muted:   #7b8c99;
            --fee-line:    #e7edf0;
            --fee-line-2:  #f1f5f7;
            --fee-surface: #ffffff;
            --fee-tint:    #f8fafb;
            --fee-brand:   #0d6f6b;
            --fee-paid:    #0f7a4e;
            --fee-paid-bg: #e8f5ee;
        }

        /* ---------- Shell ---------- */

        .fees-page .fees-card {
            background: var(--fee-surface);
            border: 1px solid var(--fee-line);
            border-radius: 12px;
            box-shadow: 0 1px 2px rgba(20,35,43,.04), 0 8px 24px -16px rgba(20,35,43,.18);
            overflow: hidden;
        }

        .fees-page .fees-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 18px 20px 16px;
            border-bottom: 1px solid var(--fee-line);
        }

        .fees-page .fees-title {
            margin: 0;
            font-size: 16.5px;
            font-weight: 650;
            letter-spacing: -.01em;
            color: var(--fee-ink);
        }

        .fees-page .fees-sub { margin: 3px 0 0; font-size: 12.5px; color: var(--fee-muted); }

        /* ---------- Summary ---------- */

        .fees-page .fees-stats {
            display: flex;
            flex-wrap: wrap;
            background: var(--fee-tint);
            border-bottom: 1px solid var(--fee-line);
        }

        .fees-page .fees-stat {
            flex: 1 1 150px;
            padding: 12px 20px;
            border-right: 1px solid var(--fee-line);
        }

        .fees-page .fees-stat:last-child { border-right: 0; }

        .fees-page .fees-stat-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--fee-muted);
        }

        .fees-page .fees-stat-value {
            margin-top: 3px;
            font-size: 17px;
            font-weight: 650;
            color: var(--fee-ink);
            font-variant-numeric: tabular-nums;
            letter-spacing: -.01em;
            white-space: nowrap;
        }

        .fees-page .fees-stat-value small {
            font-size: 11.5px;
            font-weight: 500;
            color: var(--fee-muted);
        }

        /* ---------- Toolbar ---------- */

        .fees-page .fees-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding: 14px 20px;
            border-bottom: 1px solid var(--fee-line);
        }

        .fees-page .fees-group {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            margin: 0;
        }

        .fees-page .fees-field { position: relative; display: flex; align-items: center; }

        .fees-page .fees-field > svg {
            position: absolute;
            left: 10px;
            width: 14px;
            height: 14px;
            color: var(--fee-muted);
            pointer-events: none;
        }

        .fees-page .fees-input,
        .fees-page .fees-select {
            height: 36px;
            padding: 0 11px 0 32px;
            font-size: 13px;
            color: var(--fee-ink);
            background: var(--fee-surface);
            border: 1px solid var(--fee-line);
            border-radius: 8px;
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .fees-page .fees-select {
            padding-right: 28px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%237b8c99' stroke-width='1.6'%3E%3Cpath d='M4 6.5 8 10.5 12 6.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 9px center;
            background-size: 14px;
        }

        .fees-page .fees-input:focus,
        .fees-page .fees-select:focus {
            border-color: var(--fee-brand);
            box-shadow: 0 0 0 3px rgba(13,111,107,.12);
        }

        .fees-page .fees-search { width: 240px; }
        .fees-page .fees-year   { width: 158px; }

        .fees-page .fees-file input[type=file] {
            height: 36px;
            max-width: 210px;
            font-size: 12px;
            color: var(--fee-muted);
            border: 1px dashed #d8e2e7;
            border-radius: 8px;
            padding: 7px 8px 7px 0;
            background: var(--fee-surface);
        }

        .fees-page .fees-file input[type=file]::file-selector-button {
            height: 22px;
            margin: 0 9px;
            padding: 0 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--fee-body);
            background: var(--fee-line-2);
            border: 1px solid var(--fee-line);
            border-radius: 6px;
            cursor: pointer;
        }

        .fees-page .fees-file input[type=file]::file-selector-button:hover { background: #e7eef1; }

        /* ---------- Buttons ---------- */

        .fees-page .fbtn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            height: 36px;
            padding: 0 14px;
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1;
            white-space: nowrap;
            border: 1px solid transparent;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .fees-page .fbtn-sm { height: 28px; padding: 0 10px; font-size: 11.5px; border-radius: 6px; }

        .fees-page .fbtn-solid { background: #0d6f6b; color: #fff; }
        .fees-page .fbtn-solid:hover { background: #0a5a56; color: #fff; }

        .fees-page .fbtn-ghost { background: #fff; border-color: #e7edf0; color: #3d4f5c; }
        .fees-page .fbtn-ghost:hover { background: #f8fafb; color: #14232b; }

        .fees-page .fbtn svg { width: 14px; height: 14px; flex: none; }
        .fees-page .fbtn-sm svg { width: 12px; height: 12px; }

        /* ---------- Table ---------- */

        .fees-page .fees-scroll {
            max-height: 540px;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: #c8d5db transparent;
        }

        .fees-page .fees-scroll::-webkit-scrollbar { width: 10px; height: 10px; }
        .fees-page .fees-scroll::-webkit-scrollbar-track { background: transparent; }
        .fees-page .fees-scroll::-webkit-scrollbar-thumb {
            background: #c8d5db;
            border-radius: 999px;
            border: 3px solid var(--fee-surface);
        }
        .fees-page .fees-scroll::-webkit-scrollbar-thumb:hover { background: #a6b8c1; }
        .fees-page .fees-scroll::-webkit-scrollbar-corner { background: transparent; }

        .fees-page table.fees-table {
            width: 100%;
            min-width: 760px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }

        .fees-page .fees-table thead th {
            position: sticky;
            top: 0;
            z-index: 3;
            padding: 10px 12px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--fee-muted);
            background: var(--fee-tint);
            border-bottom: 1px solid var(--fee-line);
            white-space: nowrap;
            text-align: left;
        }

        .fees-page .fees-table tbody td {
            padding: 10px 12px;
            font-size: 13px;
            color: var(--fee-body);
            background: var(--fee-surface);
            border-bottom: 1px solid var(--fee-line-2);
            vertical-align: middle;
        }

        .fees-page .fees-table tbody tr:last-child td { border-bottom: 0; }
        .fees-page .fees-table tbody tr.fee-row:hover td { background: #fbfdfd; }

        /* Column widths */
        .fees-page .c-idx     { width: 42px; }
        .fees-page .c-student { width: auto; }
        .fees-page .c-grade   { width: 88px; }
        .fees-page .c-grno    { width: 110px; }
        .fees-page .c-amount  { width: 138px; }
        .fees-page .c-actions { width: 190px; text-align: right; }

        .fees-page .c-idx {
            font-size: 11.5px;
            color: var(--fee-muted);
            font-variant-numeric: tabular-nums;
        }

        .fees-page .cell-name {
            display: block;
            font-weight: 600;
            color: var(--fee-ink);
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .fees-page .cell-sub {
            display: block;
            margin-top: 1px;
            font-size: 11px;
            color: var(--fee-muted);
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
        }

        .fees-page .cell-money {
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
            color: var(--fee-ink);
            font-size: 13px;
        }

        /* Amount — the anchor column */
        .fees-page .fees-table thead th.c-amount,
        .fees-page .fees-table tbody td.c-amount {
            background: #f4f8f8;
            border-left: 1px solid var(--fee-line);
        }

        .fees-page .fees-table thead th.c-amount { color: var(--fee-brand); }

        .fees-page .fees-table tbody tr.fee-row:hover td.c-amount { background: #eef5f5; }

        .fees-page .cell-total {
            font-size: 14.5px;
            font-weight: 700;
            color: #0b2a28;
            letter-spacing: -.015em;
        }

        .fees-page .chip {
            display: inline-block;
            max-width: 100%;
            padding: 2px 7px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--fee-body);
            background: var(--fee-line-2);
            border-radius: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .fees-page .action-stack {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        /* Mail sent state */
        .fees-page .sent-tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            height: 28px;
            padding: 0 10px;
            font-size: 11.5px;
            font-weight: 650;
            color: var(--fee-paid);
            background: var(--fee-paid-bg);
            border: 1px solid #cfe8dc;
            border-radius: 6px;
            white-space: nowrap;
        }

        /* Empty states */
        .fees-page .fees-empty td {
            padding: 44px 20px;
            text-align: center;
            font-size: 13px;
            color: var(--fee-muted);
        }

        .fees-page .fees-empty strong {
            display: block;
            margin-bottom: 3px;
            font-size: 14px;
            color: var(--fee-body);
        }

        .fees-page .fees-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            padding: 11px 20px;
            font-size: 12px;
            color: var(--fee-muted);
            background: var(--fee-tint);
            border-top: 1px solid var(--fee-line);
        }

        .fees-page .fees-hint { display: inline-flex; align-items: center; gap: 6px; }

        /* ---------- GrayQuest popup ---------- */

        #gq-overlay {
            position: fixed;
            inset: 0;
            background: rgba(20, 35, 43, 0.45);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gq-popup {
            background: #fff;
            padding: 30px 26px;
            border-radius: 14px;
            width: 330px;
            text-align: center;
            box-shadow: 0 24px 60px -20px rgba(20,35,43,.4);
        }

        .gq-popup p {
            margin: 16px 0 0;
            font-size: 13.5px;
            font-weight: 500;
            color: #3d4f5c;
            line-height: 1.5;
        }

        #gq-popup-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 34px;
            padding: 0 30px;
            margin-top: 18px;
            font-size: 12.5px;
            font-weight: 600;
            color: #fff;
            background: #0d6f6b;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }

        #gq-popup-close:hover { background: #0a5a56; }

        .gq-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .gq-icon.success { background: #e8f5ee; color: #0f7a4e; border: 2px solid #cfe8dc; }
        .gq-icon.error   { background: #fdf0ee; color: #c0392b; border: 2px solid #f6dcd8; }

        .spinner {
            width: 44px;
            height: 44px;
            margin: 0 auto;
            border: 5px solid #eef3f5;
            border-top: 5px solid #0d6f6b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ---------- Responsive ---------- */

        @media (max-width: 991.98px) {
            .fees-page .fees-search { width: 200px; }
        }

        @media (max-width: 767.98px) {
            .fees-page .fees-group,
            .fees-page .fees-field,
            .fees-page .fees-search,
            .fees-page .fees-year { width: 100%; }
            .fees-page .fees-stat { flex-basis: 50%; }
        }

        @media (prefers-reduced-motion: reduce) {
            .spinner { animation: none !important; }
        }
    </style>

</head>

        @include('components.backend.header')

        <!--start sidebar wrapper-->
        @include('components.backend.sidebar')
        <!--end sidebar wrapper-->


        <!-- Global Overlay -->
        <div id="gq-overlay" style="display:none;">
            <div class="gq-popup">
                <div class="spinner"></div>
                <div class="gq-icon success" id="gq-icon-success">✓</div>
                <div class="gq-icon error" id="gq-icon-error">✕</div>
                <p id="gq-popup-message">Processing...</p>
                <button id="gq-popup-close" class="d-none">OK</button>
            </div>
        </div>


     <div class="page-body">

          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <!-- Container-fluid starts-->
          <div class="container-fluid fees-page">

            @php
                $studentCount = count($students);
                $sentCount    = $students->where('gq_send_status', 1)->count();
                $pendingCount = $studentCount - $sentCount;
                $sumAmount    = $students->sum(fn($s) => (float) str_replace([',', '₹', ' '], '', (string) ($s->amount ?? 0)));
            @endphp

            <div class="row">
              <div class="col-sm-12">
                <div class="fees-card">

                    <!-- Header -->
                    <div class="fees-head">
                        <div>
                            <h1 class="fees-title">GrayQuest Fees</h1>
                            <p class="fees-sub">Generate GrayQuest applications and email payment links to parents.</p>
                        </div>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0" style="background:transparent; padding:0; font-size:12px;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('manage-student-details.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Student Fees Details</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Summary -->
                    <div class="fees-stats">
                        <div class="fees-stat">
                            <div class="fees-stat-label">Students</div>
                            <div class="fees-stat-value">{{ $studentCount }}</div>
                        </div>
                        <div class="fees-stat">
                            <div class="fees-stat-label">Total billed</div>
                            <div class="fees-stat-value">{{ indian_number_format($sumAmount) }}</div>
                        </div>
                        <div class="fees-stat">
                            <div class="fees-stat-label">Links sent</div>
                            <div class="fees-stat-value">
                                {{ $sentCount }} <small>of {{ $studentCount }}</small>
                            </div>
                        </div>
                        <div class="fees-stat">
                            <div class="fees-stat-label">Pending</div>
                            <div class="fees-stat-value">{{ $pendingCount }}</div>
                        </div>
                    </div>

                    <!-- Toolbar -->
                    <div class="fees-toolbar">

                        <div class="fees-group">

                            <div class="fees-field">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <path d="m20 20-3.5-3.5"></path>
                                </svg>
                                <input type="text" id="tableSearch" class="fees-input fees-search"
                                       placeholder="Search name or GR no…" autocomplete="off">
                            </div>

                            <div class="fees-field">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 5h16l-6 7v6l-4 2v-8L4 5Z"></path>
                                </svg>
                                <select id="formTypeFilter" name="year" class="fees-select fees-year">
                                    <option value="">All years</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="fees-group">

                            <a href="{{ route('graquest.export') }}" class="fbtn fbtn-ghost">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v12"></path>
                                    <path d="m7.5 10.5 4.5 4.5 4.5-4.5"></path>
                                    <path d="M4 20h16"></path>
                                </svg>
                                Export
                            </a>

                            <form action="{{ route('graquest.import') }}" method="POST"
                                  enctype="multipart/form-data" class="fees-group fees-file" style="gap:8px;">
                                @csrf

                                <input type="file" name="import_file" accept=".csv,.xls,.xlsx" required
                                       aria-label="Choose a CSV, XLS or XLSX file to import">

                                <button type="submit" class="fbtn fbtn-solid">Import</button>
                            </form>

                        </div>
                    </div>

                    @error('import_file')
                        <div class="fees-alert">{{ $message }}</div>
                    @enderror

                    <!-- Table -->
                    <div class="fees-scroll">
                        <table class="fees-table" id="bulletinTable">
                            <thead>
                                <tr>
                                    <th class="c-idx">#</th>
                                    <th class="c-student">Student</th>
                                    <th class="c-grade">Grade</th>
                                    <th class="c-grno">GR No</th>
                                    <th class="c-amount">Amount</th>
                                    <th class="c-actions">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="admissionTableBody">
                                @forelse($students as $student)

                                    <tr class="fee-row" data-year="{{ $student->year }}">

                                        <td class="c-idx">{{ $loop->iteration }}</td>

                                        <td class="c-student">
                                            <span class="cell-name">{{ $student->student_name }}</span>
                                            <span class="cell-sub">{{ $student->year }}</span>
                                        </td>

                                        <td class="c-grade"><span class="chip">{{ $student->grade }}</span></td>

                                        <td class="c-grno">
                                            <span class="cell-money">{{ $student->gr_no ?? '—' }}</span>
                                        </td>

                                        <td class="c-amount">
                                            <span class="cell-money cell-total">{{ indian_number_format($student->amount) }}</span>
                                        </td>

                                        <td class="c-actions">
                                            <div class="action-stack">

                                                @if($student->gq_send_status == 1)
                                                    <span class="sent-tag">✓ Mail Sent</span>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       class="fbtn fbtn-sm fbtn-solid payBtn"
                                                       data-gr-no="{{ $student->gr_no }}"
                                                       data-gq-student-id="{{ $student->gq_student_id }}"
                                                       data-application-id="{{ $student->gq_application_id }}"
                                                       data-reference-id="{{ $student->gq_reference_id }}"
                                                       data-mobile="{{ $student->father_mobile }}"
                                                       data-father-email="{{ $student->father_email }}"
                                                       data-mother-email="{{ $student->mother_email }}"
                                                       data-amount="{{ $student->amount }}">
                                                        <span class="btn-text">Initiate</span>
                                                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                                    </a>
                                                @endif

                                                <div class="mt-1 alert alert-danger d-none gq-alert"></div>

                                                <a href="{{ route('manage-grayquest-student.edit', $student->id) }}"
                                                   class="fbtn fbtn-sm fbtn-ghost">Details</a>

                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                    <tr class="fees-empty">
                                        <td colspan="6">
                                            <strong>No students yet</strong>
                                            Import a CSV to load GrayQuest fee records.
                                        </td>
                                    </tr>

                                @endforelse

                                <!-- Shown by JS when the filters match nothing -->
                                <tr class="fees-empty" id="noResultsRow" style="display:none;">
                                    <td colspan="6">
                                        <strong>No matching records</strong>
                                        Try a different year or clear the search.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="fees-foot">
                        <span id="rowCount">Showing {{ $studentCount }} of {{ $studentCount }} students</span>
                        <span class="fees-hint">
                            <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path d="M12 11v5"></path><path d="M12 8h.01"></path>
                            </svg>
                            Initiate generates a GrayQuest application and emails the link to parents
                        </span>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- footer start-->
        @include('components.backend.footer')
      </div>
    </div>

    @include('components.backend.main-js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!---- Filter + search ---->
    <script>
        $(document).ready(function () {

            var $rows = $('#admissionTableBody tr.fee-row');
            var total = $rows.length;

            function filterTable() {
                var selectedYear = $('#formTypeFilter').val().toLowerCase();
                var searchText   = $('#tableSearch').val().toLowerCase();
                var visible      = 0;

                $rows.each(function () {
                    var year    = String($(this).data('year') || '').toLowerCase();
                    var rowText = $(this).text().toLowerCase();

                    var match = (selectedYear === '' || year === selectedYear) &&
                                (searchText === ''   || rowText.indexOf(searchText) !== -1);

                    $(this).toggle(match);
                    if (match) visible++;
                });

                $('#noResultsRow').toggle(total > 0 && visible === 0);
                $('#rowCount').text('Showing ' + visible + ' of ' + total + ' students');
            }

            $('#formTypeFilter').on('change', filterTable);
            $('#tableSearch').on('keyup', filterTable);
        });
    </script>


    <!---- Popup helpers ---->
    <script>
        function resetPopupIcons() {
            $('.gq-popup .spinner').hide();
            $('#gq-icon-success').css('display', 'none');
            $('#gq-icon-error').css('display', 'none');
        }

        function showPopup(message) {
            resetPopupIcons();
            $('.gq-popup .spinner').show();
            $('#gq-popup-message').text(message);
            $('#gq-popup-close').addClass('d-none');
            $('#gq-overlay').fadeIn(200);
        }

        function showPopupSuccess(message) {
            resetPopupIcons();
            $('#gq-icon-success').css('display', 'flex');
            $('#gq-popup-message').text(message);
            $('#gq-popup-close').removeClass('d-none');
        }

        function showPopupError(message) {
            resetPopupIcons();
            $('#gq-icon-error').css('display', 'flex');
            $('#gq-popup-message').text(message);
            $('#gq-popup-close').removeClass('d-none');
        }

        $('#gq-popup-close').on('click', function () {
            $('#gq-overlay').fadeOut(200);
        });
    </script>


    <!---- GrayQuest Initiate flow ---->
    <script>
        $(document).on('click', '.payBtn', function () {

            let btn = $(this);
            let existingGrNo = btn.data('gr-no') || null;
            let mobile = String(btn.data('mobile')).trim();
            let amount = btn.data('amount');
            let fatherEmail = btn.data('father-email') || null;
            let motherEmail = btn.data('mother-email') || null;

            showPopup('Generating GrayQuest application...');

            $.ajax({
                url: "{{ route('grayquest.generateIDs') }}",
                type: "POST",
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                data: {
                    gr_no: existingGrNo,
                    amount: amount,
                    father_email: fatherEmail,
                    mother_email: motherEmail
                },
                success: function (response) {

                    if (!response.success) {
                        showPopupError('Failed to generate GrayQuest IDs.');
                        return;
                    }

                    let gqStudentId = response.gq_student_id;
                    let gqApplicationId = response.gq_application_id;
                    let gqReferenceId = response.gq_reference_id;

                    if (!gqStudentId || !gqApplicationId || !gqReferenceId) {
                        showPopupError('Incomplete GrayQuest data received.');
                        return;
                    }

                    mobile = mobile.replace(/\D/g, '');
                    if (mobile.length !== 10) {
                        showPopupError('Mobile number must be 10 digits.');
                        return;
                    }

                    showPopup('Sending email...');

                    $.ajax({
                        url: "{{ route('grayquest.sendMail') }}",
                        type: "POST",
                        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                        data: {
                            gq_student_id: gqStudentId,
                            gq_application_id: gqApplicationId,
                            gq_reference_id: gqReferenceId,
                            gr_no: existingGrNo,
                            amount: amount
                        },
                        success: function (mailResponse) {

                            if (!mailResponse.success) {
                                showPopupError('Email sending failed.');
                                return;
                            }

                            showPopupSuccess('GrayQuest email sent successfully.');

                            // Lock button
                            btn.replaceWith(
                                '<span class="sent-tag">✓ Mail Sent</span>'
                            );
                        },
                        error: function () {
                            showPopupError('Server error while sending email.');
                        }
                    });
                },
                error: function () {
                    showPopupError('Server error while sending email.');
                }
            });
        });
    </script>

</body>

</html>