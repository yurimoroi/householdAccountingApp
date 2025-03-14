@extends('layout.layout')
@section('title', 'Report')
@section('display_name', 'Report')
@section('class_name', 'p-report')

@section('main')
    <section class="e-month">
        <span class="e-btn previous">Previous</span>

        <div class="e-input">
            <input type="month">

            <label class="e-placeholder">Month</label>
        </div>
        <span class="e-btn next">Next</span>
    </section>

    <section class="e-chart">
        <div class="e-pie">
            <div class="e-input">
                <select>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>

                <label class="e-placeholder">Kind of Balance</label>
            </div>

            <div class="e-pie"></div>
        </div>

        <div class="e-bar">
        </div>
    </section>

    <section class="e-monthly-report">
        <div class="e-cards">
            <div class="e-card income">
                <p class="e-title">Income</p>
                <p class="e-amount"></p>
            </div>
            <div class="e-card expense">
                <p class="e-title">Expense</p>
                <p class="e-amount"></p>
            </div>
            <div class="e-card balance">
                <p class="e-title">Balance</p>
                <p class="e-amount"></p>
            </div>
        </div>

        <div class="e-titles">
            <h3 class="e-title active">Monthly Report</h3>

            <div class="e-deletes">
                <h3 class="e-select">1 selected</h3>

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M9 3V4H4V6H5V19C5 19.5304 5.21071 20.0391 5.58579 20.4142C5.96086 20.7893 6.46957 21 7 21H17C17.5304 21 18.0391 20.7893 18.4142 20.4142C18.7893 20.0391 19 19.5304 19 19V6H20V4H15V3H9ZM9 8H11V17H9V8ZM13 8H15V17H13V8Z"
                        fill="#646A6E" />
                </svg>

            </div>
        </div>

        <table class="e-report-table">
            <thead class="e-head">
                <th><input type="checkbox"></th>
                <th>Date</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Content</th>
            </thead>

            <tbody class="e-body">
            </tbody>
        </table>

        <div class="e-pagenation">
            <div class="e-btns">
                <input type="hidden" name="pageNum" id="page-num" value="0">
                <span class="e-btn previous">&lt;</span>
                <span class="e-btn next">&gt;</span>
            </div>
        </div>
    </section>

    <script type="module" src="{{ asset('/js/report.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let items = @json($items)
    </script>
@endsection
