<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')

    <style>
        /* ============================================================
           Student Fees — scoped styles (.fees-page / .fees-modal)
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
            --fee-due:     #9a5b0c;
            --fee-due-bg:  #fdf2e4;
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

        .fees-page .fbtn,
        .fees-modal .fbtn {
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

        .fees-page .fbtn-solid,
        .fees-modal .fbtn-solid { background: #0d6f6b; color: #fff; }
        .fees-page .fbtn-solid:hover,
        .fees-modal .fbtn-solid:hover { background: #0a5a56; color: #fff; }

        .fees-page .fbtn-ghost,
        .fees-modal .fbtn-ghost { background: #fff; border-color: #e7edf0; color: #3d4f5c; }
        .fees-page .fbtn-ghost:hover,
        .fees-modal .fbtn-ghost:hover { background: #f8fafb; color: #14232b; }

        .fees-page .fbtn svg,
        .fees-modal .fbtn svg { width: 14px; height: 14px; flex: none; }
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
            min-width: 860px;
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
        .fees-page .c-emi     { width: 116px; }
        .fees-page .c-total   { width: 128px; }
        .fees-page .c-actions { width: 168px; text-align: right; }

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
            font-size: 12.5px;
        }

        .fees-page .money-blank { color: #ccd6db; }

        /* Total fee — the anchor column, deliberately heavier than the EMIs */
        .fees-page .fees-table thead th.c-total,
        .fees-page .fees-table tbody td.c-total {
            background: #f4f8f8;
            border-left: 1px solid var(--fee-line);
        }

        .fees-page .fees-table thead th.c-total { color: var(--fee-brand); }

        .fees-page .fees-table tbody tr.fee-row:hover td.c-total { background: #eef5f5; }

        .fees-page .cell-total {
            font-size: 15px;
            font-weight: 700;
            color: #0b2a28;
            letter-spacing: -.015em;
        }

        .fees-page .cell-total.is-settled { color: var(--fee-paid); }

        .fees-page .cell-due {
            display: block;
            margin-top: 1px;
            font-size: 10.5px;
            font-weight: 600;
            color: var(--fee-due);
            font-variant-numeric: tabular-nums;
            white-space: nowrap;
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

        /* Paid marker — inline, keeps rows short */
        .fees-page .tick {
            display: inline-block;
            margin-left: 5px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .02em;
            color: var(--fee-paid);
            vertical-align: 1px;
        }

        .fees-page .tick::before { content: "✓ "; }

        /* Editable cells */
        .fees-page td.editable { cursor: pointer; }

        .fees-page td.editable:not(.not-editable):hover {
            background: #f2f9f9 !important;
            box-shadow: inset 2px 0 0 var(--fee-brand);
        }

        .fees-page td.editable:not(.not-editable):hover .cell-money {
            text-decoration: underline;
            text-decoration-style: dotted;
            text-underline-offset: 3px;
        }

        .fees-page td.not-editable { cursor: not-allowed; }

        .fees-page .action-stack {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .fees-page .paid-tag {
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

        .fees-page .fees-alert {
            padding: 10px 20px;
            font-size: 12.5px;
            color: #c0392b;
            background: #fdf0ee;
            border-bottom: 1px solid #f6dcd8;
        }

        /* ---------- Modal ---------- */

        .fees-modal {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 24px 60px -20px rgba(20,35,43,.4);
        }

        .fees-modal .modal-header { padding: 17px 20px 13px; border-bottom: 1px solid #e7edf0; }
        .fees-modal .modal-title  { font-size: 15px; font-weight: 650; color: #14232b; }
        .fees-modal .modal-body   { padding: 18px 20px; }

        .fees-modal .modal-footer {
            padding: 13px 20px;
            gap: 8px;
            background: #f8fafb;
            border-top: 1px solid #e7edf0;
        }

        .fees-modal .m-student {
            padding: 11px 13px;
            margin-bottom: 16px;
            background: #f8fafb;
            border: 1px solid #eef3f5;
            border-radius: 9px;
        }

        .fees-modal .m-student-name { font-size: 14px; font-weight: 650; color: #14232b; }

        .fees-modal .m-student-meta {
            margin-top: 2px;
            font-size: 11.5px;
            color: #7b8c99;
            font-variant-numeric: tabular-nums;
        }

        .fees-modal .m-label {
            display: block;
            margin-bottom: 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #7b8c99;
        }

        .fees-modal .m-control {
            width: 100%;
            height: 40px;
            padding: 0 12px;
            font-size: 13.5px;
            color: #14232b;
            background: #fff;
            border: 1px solid #e7edf0;
            border-radius: 8px;
            outline: none;
        }

        .fees-modal select.m-control {
            appearance: none;
            padding-right: 32px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%237b8c99' stroke-width='1.6'%3E%3Cpath d='M4 6.5 8 10.5 12 6.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 11px center;
            background-size: 14px;
        }

        .fees-modal .m-control:focus {
            border-color: #0d6f6b;
            box-shadow: 0 0 0 3px rgba(13,111,107,.12);
        }

        .fees-modal .m-control[readonly] {
            background: #f8fafb;
            font-weight: 650;
            font-variant-numeric: tabular-nums;
        }

        .fees-modal .m-note { margin: 13px 0 0; font-size: 11.5px; color: #7b8c99; }

        /* ---------- Toasts ---------- */

        #feeToasts {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 12000;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .fee-toast {
            min-width: 240px;
            max-width: 340px;
            padding: 11px 13px;
            font-size: 12.5px;
            font-weight: 500;
            color: #14232b;
            background: #fff;
            border: 1px solid #e7edf0;
            border-left: 3px solid #0d6f6b;
            border-radius: 9px;
            box-shadow: 0 12px 30px -12px rgba(20,35,43,.3);
            animation: feeToastIn .22s ease both;
        }

        .fee-toast.is-ok   { border-left-color: #0f7a4e; }
        .fee-toast.is-warn { border-left-color: #c98b12; }
        .fee-toast.is-err  { border-left-color: #c0392b; }
        .fee-toast.is-out  { animation: feeToastOut .2s ease both; }

        @keyframes feeToastIn  { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform:none; } }
        @keyframes feeToastOut { from { opacity:1; transform:none; } to { opacity:0; transform: translateY(6px); } }

        /* ---------- Loader ---------- */

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
            #feeToasts { right: 12px; left: 12px; bottom: 12px; }
            .fee-toast { max-width: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            .fee-toast, .spinner { animation: none !important; }
        }
    </style>

</head>

        @include('components.backend.header')

        <!--start sidebar wrapper-->
        @include('components.backend.sidebar')
        <!--end sidebar wrapper-->


        <!-- Loader overlay -->
        <div id="mail-loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(255,255,255,.86); z-index:9999; text-align:center;">
            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);">
                <div class="spinner"></div>
                <p style="margin-top:13px; font-size:13px; color:#3d4f5c;">Sending payment email…</p>
            </div>
        </div>

        <!-- Toast host -->
        <div id="feeToasts"></div>


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
                // ----------------------------------------------------------
                // Derive real payment state per student from the stored JSON.
                // Money columns are strings, so strip formatting before maths.
                // ----------------------------------------------------------
                $num = fn($v) => (float) str_replace([',', '₹', ' '], '', (string) ($v ?? 0));

                $derived      = [];
                $sumBilled    = 0;
                $sumCollected = 0;
                $countPaid    = 0;

                foreach ($students as $s) {

                    $total = $num($s->amount);
                    $paid  = 0;
                    $slots = [];

                    foreach ([
                        'emi_1' => 'emi1_details',
                        'emi_2' => 'emi2_details',
                        'emi_3' => 'emi3_details',
                        'full'  => 'fullamount_details',
                    ] as $key => $col) {

                        $json        = $s->$col ? json_decode($s->$col, true) : null;
                        $slots[$key] = $json ? $num($json['amount'] ?? 0) : 0;
                        $paid       += $slots[$key];
                    }

                    // A FULL record worth less than the total fee is a misfiled
                    // instalment — match it back to the EMI it actually was.
                    if ($slots['full'] > 0 && $slots['full'] < $total) {
                        foreach (['emi_1', 'emi_2', 'emi_3'] as $f) {
                            if ($slots[$f] == 0 && $num($s->$f) == $slots['full']) {
                                $slots[$f] = $slots['full'];
                                break;
                            }
                        }
                        $slots['full'] = 0;
                    }

                    $isPaid = $total > 0 && $paid >= $total;

                    $derived[$s->id] = [
                        'total'    => $total,
                        'paid'     => $paid,
                        'balance'  => max($total - $paid, 0),
                        'emi1Paid' => $slots['emi_1'] > 0,
                        'emi2Paid' => $slots['emi_2'] > 0,
                        'emi3Paid' => $slots['emi_3'] > 0,
                        'isPaid'   => $isPaid,
                    ];

                    $sumBilled    += $total;
                    $sumCollected += min($paid, $total);
                    $countPaid    += $isPaid ? 1 : 0;
                }

                $studentCount   = count($students);
                $sumOutstanding = max($sumBilled - $sumCollected, 0);
                $collectionPct  = $sumBilled > 0 ? round($sumCollected / $sumBilled * 100) : 0;
            @endphp

            <div class="row">
              <div class="col-sm-12">
                <div class="fees-card">

                    <!-- Header -->
                    <div class="fees-head">
                        <div>
                            <h1 class="fees-title">Student Fees</h1>
                            <p class="fees-sub">Track instalments, send payment links and reconcile collections.</p>
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
                            <div class="fees-stat-label">Collected</div>
                            <div class="fees-stat-value">
                                {{ indian_number_format($sumCollected) }}
                                <small>· {{ $collectionPct }}%</small>
                            </div>
                        </div>
                        <div class="fees-stat">
                            <div class="fees-stat-label">Outstanding</div>
                            <div class="fees-stat-value">{{ indian_number_format($sumOutstanding) }}</div>
                        </div>
                        <div class="fees-stat">
                            <div class="fees-stat-label">Settled</div>
                            <div class="fees-stat-value">
                                {{ $countPaid }} <small>of {{ $studentCount }}</small>
                            </div>
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

                            <a href="{{ route('students.export') }}" class="fbtn fbtn-ghost">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3v12"></path>
                                    <path d="m7.5 10.5 4.5 4.5 4.5-4.5"></path>
                                    <path d="M4 20h16"></path>
                                </svg>
                                Export
                            </a>

                            <form action="{{ route('student.import') }}" method="POST"
                                  enctype="multipart/form-data" class="fees-group fees-file" style="gap:8px;">
                                @csrf

                                <input type="file" name="import_file" accept=".csv,.txt" required
                                       aria-label="Choose a CSV or TXT file to import">

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
                                    <th class="c-emi">EMI 1</th>
                                    <th class="c-emi">EMI 2</th>
                                    <th class="c-emi">EMI 3</th>
                                    <th class="c-total">Total fee</th>
                                    <th class="c-actions">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="admissionTableBody">
                                @forelse($students as $student)

                                    @php $d = $derived[$student->id]; @endphp

                                    <tr class="fee-row" data-year="{{ $student->year }}">

                                        <td class="c-idx">{{ $loop->iteration }}</td>

                                        <td class="c-student">
                                            <span class="cell-name">{{ $student->student_name }}</span>
                                            <span class="cell-sub">GR {{ $student->gr_no }} · {{ $student->year }}</span>
                                        </td>

                                        <td class="c-grade"><span class="chip">{{ $student->grade }}</span></td>

                                        <!-- EMI 1 -->
                                        <td class="c-emi editable {{ $d['emi1Paid'] ? 'not-editable' : '' }}"
                                            data-field="emi_1"
                                            data-id="{{ $student->id }}"
                                            data-total-amount="{{ $d['total'] }}"
                                            data-paid-amount="{{ $d['paid'] }}"
                                            title="{{ $d['emi1Paid'] ? 'Paid — locked' : 'Double-click to edit' }}">
                                            <span class="cell-money {{ $num($student->emi_1) > 0 ? '' : 'money-blank' }}">
                                                {{ $num($student->emi_1) > 0 ? indian_number_format($student->emi_1) : '—' }}
                                            </span>
                                            @if($d['emi1Paid'])<span class="tick">Paid</span>@endif
                                        </td>

                                        <!-- EMI 2 -->
                                        <td class="c-emi editable {{ $d['emi2Paid'] ? 'not-editable' : '' }}"
                                            data-field="emi_2"
                                            data-id="{{ $student->id }}"
                                            data-total-amount="{{ $d['total'] }}"
                                            data-paid-amount="{{ $d['paid'] }}"
                                            title="{{ $d['emi2Paid'] ? 'Paid — locked' : 'Double-click to edit' }}">
                                            <span class="cell-money {{ $num($student->emi_2) > 0 ? '' : 'money-blank' }}">
                                                {{ $num($student->emi_2) > 0 ? indian_number_format($student->emi_2) : '—' }}
                                            </span>
                                            @if($d['emi2Paid'])<span class="tick">Paid</span>@endif
                                        </td>

                                        <!-- EMI 3 -->
                                        <td class="c-emi editable {{ $d['emi3Paid'] ? 'not-editable' : '' }}"
                                            data-field="emi_3"
                                            data-id="{{ $student->id }}"
                                            data-total-amount="{{ $d['total'] }}"
                                            data-paid-amount="{{ $d['paid'] }}"
                                            title="{{ $d['emi3Paid'] ? 'Paid — locked' : 'Double-click to edit' }}">
                                            <span class="cell-money {{ $num($student->emi_3) > 0 ? '' : 'money-blank' }}">
                                                {{ $num($student->emi_3) > 0 ? indian_number_format($student->emi_3) : '—' }}
                                            </span>
                                            @if($d['emi3Paid'])<span class="tick">Paid</span>@endif
                                        </td>

                                        <!-- Total -->
                                        <td class="c-total">
                                            <span class="cell-money cell-total {{ $d['isPaid'] ? 'is-settled' : '' }}">{{ indian_number_format($student->amount) }}</span>
                                            @if(!$d['isPaid'] && $d['paid'] > 0)
                                                <span class="cell-due">{{ indian_number_format($d['balance']) }} due</span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="c-actions">
                                            <div class="action-stack">

                                                @if($d['isPaid'])
                                                    <span class="paid-tag">✓ Paid</span>
                                                @else
                                                    <a href="javascript:void(0);"
                                                       class="fbtn fbtn-sm fbtn-solid payBtn"
                                                       data-id="{{ $student->id }}"
                                                       data-name="{{ $student->student_name }}"
                                                       data-grade="{{ $student->grade }}"
                                                       data-grno="{{ $student->gr_no }}"
                                                       data-emi1="{{ $num($student->emi_1) }}"
                                                       data-emi2="{{ $num($student->emi_2) }}"
                                                       data-emi3="{{ $num($student->emi_3) }}"
                                                       data-fatheremail="{{ $student->father_email }}"
                                                       data-motheremail="{{ $student->mother_email }}"
                                                       data-emi1paid="{{ $d['emi1Paid'] ? 1 : 0 }}"
                                                       data-emi2paid="{{ $d['emi2Paid'] ? 1 : 0 }}"
                                                       data-emi3paid="{{ $d['emi3Paid'] ? 1 : 0 }}"
                                                       data-balance="{{ $d['balance'] }}"
                                                       data-fullamount="{{ $d['total'] }}">
                                                       Initiate
                                                    </a>
                                                @endif

                                                <a href="{{ route('manage-student-details.edit', $student->id) }}"
                                                   class="fbtn fbtn-sm fbtn-ghost">Details</a>

                                            </div>
                                        </td>
                                    </tr>

                                @empty

                                    <tr class="fees-empty">
                                        <td colspan="8">
                                            <strong>No students yet</strong>
                                            Import a CSV to load fee records for the academic year.
                                        </td>
                                    </tr>

                                @endforelse

                                <!-- Shown by JS when the filters match nothing -->
                                <tr class="fees-empty" id="noResultsRow" style="display:none;">
                                    <td colspan="8">
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
                            Double-click an unpaid EMI to edit it
                        </span>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Payment Modal -->
        <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content fees-modal">

                    <div class="modal-header">
                        <h5 class="modal-title" id="payModalLabel">Send payment link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="m-student">
                            <div class="m-student-name" id="payStudentName"></div>
                            <div class="m-student-meta" id="payStudentMeta"></div>
                        </div>

                        <div class="mb-3">
                            <label class="m-label" for="emiSelect">Instalment</label>
                            <select id="emiSelect" class="m-control"></select>
                        </div>

                        <div>
                            <label class="m-label" for="emiAmount">Amount payable</label>
                            <input type="text" id="emiAmount" class="m-control" readonly>
                        </div>

                        <p class="m-note">
                            The link is emailed to both parents on record and stays valid until
                            the instalment is paid.
                        </p>

                    </div>

                    <div class="modal-footer">
                        <button class="fbtn fbtn-ghost" data-bs-dismiss="modal">Cancel</button>
                        <button class="fbtn fbtn-solid" id="confirmPayBtn">Send link</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- footer start-->
        @include('components.backend.footer')
      </div>
    </div>

    @include('components.backend.main-js')


    <!---- Toasts ---->
    <script>
        function feeToast(message, type) {
            var host = document.getElementById('feeToasts');
            if (!host) { alert(message); return; }

            var el = document.createElement('div');
            el.className = 'fee-toast is-' + (type || 'ok');
            el.setAttribute('role', 'status');
            el.textContent = message;
            host.appendChild(el);

            setTimeout(function () {
                el.classList.add('is-out');
                setTimeout(function () { el.remove(); }, 220);
            }, 3600);
        }
    </script>


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


 <script>

    // <!---- Inline EMI editing ---->
    document.addEventListener("DOMContentLoaded", function () {

        // Click on the confirm icon
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("update-icon")) {

                var cell  = e.target.closest(".editable");
                var input = cell.querySelector("input");

                var id       = cell.dataset.id;
                var field    = cell.dataset.field;
                var newValue = input.value.trim().replace(/,/g, "");
                var original = cell.dataset.original;

                var totalAmount = parseFloat(cell.dataset.totalAmount || 0);
                var paidAmount  = parseFloat(cell.dataset.paidAmount || 0);

                if (totalAmount > 0 && paidAmount >= totalAmount) {
                    feeToast("Fees are fully paid. Instalments can no longer be changed.", "warn");
                    cell.innerHTML = original;
                    return;
                }

                if (cell.classList.contains("not-editable")) {
                    feeToast("This instalment is already paid and is locked.", "warn");
                    cell.innerHTML = original;
                    return;
                }

                saveValue(cell, id, field, newValue, original);
            }
        });

        // Double click to edit
        document.querySelectorAll(".editable").forEach(function (cell) {

            cell.addEventListener("dblclick", function () {

                if (cell.querySelector("input")) return;   // already editing

                var totalAmount = parseFloat(cell.dataset.totalAmount || 0);
                var paidAmount  = parseFloat(cell.dataset.paidAmount || 0);

                if (totalAmount > 0 && paidAmount >= totalAmount) {
                    feeToast("Fees are fully paid. Instalments can no longer be changed.", "warn");
                    return;
                }

                if (cell.classList.contains("not-editable")) {
                    feeToast("This instalment is already paid and is locked.", "warn");
                    return;
                }

                cell.dataset.original = cell.innerHTML;

                var moneyEl = cell.querySelector('.cell-money');
                var current = (moneyEl ? moneyEl.textContent : cell.innerText)
                                .replace(/[₹,\s—]/g, "")
                                .trim();

                function restore() { cell.innerHTML = cell.dataset.original; }

                var wrapper = document.createElement("div");
                wrapper.style.display    = "flex";
                wrapper.style.alignItems = "center";
                wrapper.style.gap        = "5px";

                var input = document.createElement("input");
                input.type      = "text";
                input.value     = current;
                input.className = "fees-input";
                input.style.height   = "28px";
                input.style.width    = "88px";
                input.style.padding  = "0 8px";
                input.style.fontSize = "12.5px";

                var updateBtn = document.createElement("i");
                updateBtn.setAttribute("data-feather", "check-circle");
                updateBtn.classList.add("update-icon");
                updateBtn.style.cursor = "pointer";
                updateBtn.style.color  = "#0f7a4e";

                wrapper.appendChild(input);
                wrapper.appendChild(updateBtn);

                cell.innerHTML = "";
                cell.appendChild(wrapper);

                input.focus();
                input.select();

                input.addEventListener("keydown", function (ev) {
                    if (ev.key === "Enter")  { ev.preventDefault(); updateBtn.click(); }
                    if (ev.key === "Escape") { restore(); }
                });

                if (window.feather) feather.replace();
            });
        });

    });


    // Save value function
    function saveValue(cell, id, field, newValue, original) {

        fetch("{{ route('update.emi') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id, field: field, value: newValue })
        })
        .then(res => res.json())
        .then(data => {

            if (data.status === true) {
                feeToast("Instalment updated.", "ok");
                setTimeout(function () { location.reload(); }, 600);
            } else {
                cell.innerHTML = original;
                feeToast(data.msg, "err");
            }
        })
        .catch(() => {
            cell.innerHTML = original;
            feeToast("Could not save the instalment. Please try again.", "err");
        });
    }


    // <!---- Instalment selection modal ---->
    $(document).on('click', '.payBtn', function () {

        var btn = $(this);

        var name        = btn.data('name');
        var fatherEmail = btn.data('fatheremail');
        var motherEmail = btn.data('motheremail');
        var fullAmount  = parseFloat(btn.data('fullamount') || 0);

        if (!name || !fatherEmail || !motherEmail || fullAmount <= 0) {
            feeToast("Add the fee amount and both parent emails before sending a link.", "warn");
            return;
        }

        var emi1Paid = btn.data('emi1paid') == 1;
        var emi2Paid = btn.data('emi2paid') == 1;
        var emi3Paid = btn.data('emi3paid') == 1;

        var balance = parseFloat(btn.data('balance') || 0);

        if (balance <= 0) {
            feeToast("Nothing left to pay for this student.", "warn");
            return;
        }

        var studentId = btn.data('id');
        var emi1 = parseFloat(btn.data('emi1') || 0);
        var emi2 = parseFloat(btn.data('emi2') || 0);
        var emi3 = parseFloat(btn.data('emi3') || 0);

        var inr = new Intl.NumberFormat('en-IN');

        $("#payStudentName").text(name);
        $("#payStudentMeta").text(
            'Grade ' + btn.data('grade') +
            ' · GR ' + btn.data('grno') +
            ' · ₹' + inr.format(balance) + ' outstanding'
        );

        $("#confirmPayBtn").data('id', studentId);

        var emiSelect = $("#emiSelect");
        emiSelect.empty();

        if (emi1 > 0 && !emi1Paid) {
            emiSelect.append('<option value="' + emi1 + '">EMI 1 — ₹' + inr.format(emi1) + '</option>');
        }
        if (emi2 > 0 && !emi2Paid) {
            emiSelect.append('<option value="' + emi2 + '">EMI 2 — ₹' + inr.format(emi2) + '</option>');
        }
        if (emi3 > 0 && !emi3Paid) {
            emiSelect.append('<option value="' + emi3 + '">EMI 3 — ₹' + inr.format(emi3) + '</option>');
        }

        // No instalment slots left but money is still due — offer the balance
        if (emiSelect.children().length === 0) {
            emiSelect.append('<option value="' + balance + '">Balance — ₹' + inr.format(balance) + '</option>');
        }

        $("#emiAmount").val('₹' + inr.format(emiSelect.val()));

        $("#payModal").modal('show');
    });


    // Amount box follows the dropdown
    $(document).on('change', '#emiSelect', function () {
        $("#emiAmount").val('₹' + new Intl.NumberFormat('en-IN').format($(this).val()));
    });


    // Send the payment mail
    $('#confirmPayBtn').on('click', function () {

        var studentId = $(this).data('id');
        var amount    = $('#emiSelect').val();

        if (!studentId || !amount) {
            feeToast("Select an instalment before sending.", "warn");
            return;
        }

        $('#confirmPayBtn').prop('disabled', true).text('Sending…');
        $('#mail-loader').show();

        $.ajax({
            url: "{{ route('send.payment.mail') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                student_id: studentId,
                amount: amount
            },
            success: function () {
                $('#payModal').modal('hide');
                feeToast("Payment link emailed to both parents.", "ok");
            },
            error: function () {
                feeToast("The email could not be sent. Please try again.", "err");
            },
            complete: function () {
                $('#mail-loader').hide();
                $('#confirmPayBtn').prop('disabled', false).text('Send link');
            }
        });
    });

 </script>


</body>

</html>