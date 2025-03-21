@extends('layout.layout')
@section('title', 'Dashboard')
@section('display_name', 'Dashboard')
@section('class_name', 'p-dashboard')

@section('main')
    <section class="e-balance">
        <x-balanceCard priority="income" title="Income" amount="123,456,789">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_3_8)">
                    <path
                        d="M12.707 3.63599C12.5194 3.44852 12.2651 3.3432 12 3.3432C11.7348 3.3432 11.4805 3.44852 11.293 3.63599L5.63598 9.29299C5.54047 9.38523 5.46428 9.49558 5.41188 9.61758C5.35947 9.73959 5.33188 9.87081 5.33073 10.0036C5.32957 10.1364 5.35487 10.268 5.40516 10.3909C5.45544 10.5138 5.52969 10.6255 5.62358 10.7194C5.71747 10.8133 5.82913 10.8875 5.95202 10.9378C6.07492 10.9881 6.2066 11.0134 6.33938 11.0122C6.47216 11.0111 6.60338 10.9835 6.72538 10.9311C6.84739 10.8787 6.95773 10.8025 7.04998 10.707L11 6.75699V20C11 20.2652 11.1053 20.5196 11.2929 20.7071C11.4804 20.8946 11.7348 21 12 21C12.2652 21 12.5195 20.8946 12.7071 20.7071C12.8946 20.5196 13 20.2652 13 20V6.75699L16.95 10.707C17.1386 10.8891 17.3912 10.9899 17.6534 10.9877C17.9156 10.9854 18.1664 10.8802 18.3518 10.6948C18.5372 10.5094 18.6424 10.2586 18.6447 9.99639C18.6469 9.73419 18.5461 9.48159 18.364 9.29299L12.707 3.63599Z"
                        fill="#fff" />
                </g>
                <defs>
                    <clipPath id="clip0_3_8">
                        <rect width="24" height="24" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </x-balanceCard>

        <x-balanceCard priority="expense" title="Expense" amount="123,456,789">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_3_12)">
                    <path
                        d="M11.293 20.364C11.4806 20.5515 11.7349 20.6568 12 20.6568C12.2652 20.6568 12.5195 20.5515 12.707 20.364L18.364 14.707C18.4595 14.6148 18.5357 14.5044 18.5881 14.3824C18.6405 14.2604 18.6681 14.1292 18.6693 13.9964C18.6704 13.8636 18.6451 13.732 18.5948 13.6091C18.5446 13.4862 18.4703 13.3745 18.3764 13.2806C18.2825 13.1867 18.1709 13.1125 18.048 13.0622C17.9251 13.0119 17.7934 12.9866 17.6606 12.9878C17.5278 12.9889 17.3966 13.0165 17.2746 13.0689C17.1526 13.1213 17.0423 13.1975 16.95 13.293L13 17.243L13 4.00001C13 3.7348 12.8947 3.48044 12.7071 3.29291C12.5196 3.10537 12.2652 3.00001 12 3.00001C11.7348 3.00001 11.4805 3.10537 11.2929 3.29291C11.1054 3.48044 11 3.7348 11 4.00001L11 17.243L7.05002 13.293C6.86142 13.1109 6.60882 13.0101 6.34662 13.0123C6.08443 13.0146 5.83361 13.1198 5.6482 13.3052C5.4628 13.4906 5.35763 13.7414 5.35535 14.0036C5.35307 14.2658 5.45386 14.5184 5.63602 14.707L11.293 20.364Z"
                        fill="#fff" />
                </g>
                <defs>
                    <clipPath id="clip0_3_12">
                        <rect width="24" height="24" fill="white" transform="matrix(-1 0 0 -1 24 24)" />
                    </clipPath>
                </defs>
            </svg>
        </x-balanceCard>

        <x-balanceCard priority="balance" title="Balance" amount="123,456,789">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.5 1L2 6V8H21V6M16 10V17H19V10M2 22H21V19H2M10 10V17H13V10M4 10V17H7V10H4Z" fill="#fff" />
            </svg>
        </x-balanceCard>

    </section>
    <section class="e-calendar">
        <div id='calendar'></div>
    </section>


    <section class="e-detail">
        <div class="e-right">
            <div class="e-header">
                <div class="e-dates">
                    <span class="e-title">Date：</span>
                    <span class="e-date"></span>
                </div>

                <div class="e-balance">
                    <div class="e-balance-above">
                        <x-balanceCardMini title="Income" priority="income" amount="0"></x-balanceCardMini>

                        <x-balanceCardMini title="Expense" priority="expense" amount="0"></x-balanceCardMini>
                    </div>
                    <div class="e-balance-below">
                        <x-balanceCardMini title="Balance" priority="balance" amount="0"></x-balanceCardMini>
                    </div>
                </div>

                <div class="e-detail-title">
                    <div class="e-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.25 7C3.25 6.80109 3.32902 6.61032 3.46967 6.46967C3.61032 6.32902 3.80109 6.25 4 6.25H20C20.1989 6.25 20.3897 6.32902 20.5303 6.46967C20.671 6.61032 20.75 6.80109 20.75 7C20.75 7.19891 20.671 7.38968 20.5303 7.53033C20.3897 7.67098 20.1989 7.75 20 7.75H4C3.80109 7.75 3.61032 7.67098 3.46967 7.53033C3.32902 7.38968 3.25 7.19891 3.25 7ZM3.25 12C3.25 11.8011 3.32902 11.6103 3.46967 11.4697C3.61032 11.329 3.80109 11.25 4 11.25H15C15.1989 11.25 15.3897 11.329 15.5303 11.4697C15.671 11.6103 15.75 11.8011 15.75 12C15.75 12.1989 15.671 12.3897 15.5303 12.5303C15.3897 12.671 15.1989 12.75 15 12.75H4C3.80109 12.75 3.61032 12.671 3.46967 12.5303C3.32902 12.3897 3.25 12.1989 3.25 12ZM3.25 17C3.25 16.8011 3.32902 16.6103 3.46967 16.4697C3.61032 16.329 3.80109 16.25 4 16.25H9C9.19891 16.25 9.38968 16.329 9.53033 16.4697C9.67098 16.6103 9.75 16.8011 9.75 17C9.75 17.1989 9.67098 17.3897 9.53033 17.5303C9.38968 17.671 9.19891 17.75 9 17.75H4C3.80109 17.75 3.61032 17.671 3.46967 17.5303C3.32902 17.3897 3.25 17.1989 3.25 17Z"
                                fill="#666" />
                        </svg>

                        <span class="e-title-text">Details</span>
                    </div>

                    <div class="e-add">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M8 1.5C4.416 1.5 1.5 4.416 1.5 8C1.5 11.584 4.416 14.5 8 14.5C11.584 14.5 14.5 11.584 14.5 8C14.5 4.416 11.584 1.5 8 1.5ZM8 2.5C11.0435 2.5 13.5 4.9565 13.5 8C13.5 11.0435 11.0435 13.5 8 13.5C4.9565 13.5 2.5 11.0435 2.5 8C2.5 4.9565 4.9565 2.5 8 2.5ZM7.5 5V7.5H5V8.5H7.5V11H8.5V8.5H11V7.5H8.5V5H7.5Z"
                                fill="#2096F3" />
                        </svg>

                        <span class="e-add-text">Add Item</span>
                    </div>
                </div>
            </div>

            <ul class="e-list">
            </ul>
        </div>

        <div class="e-input-form">
            <div class="e-title">
                <span class="e-title-text">Form</span>

                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                    <path
                        d="M24.48 26.3733L16 17.88L7.51998 26.3733L5.62665 24.48L14.12 16L5.62665 7.51998L7.51998 5.62665L16 14.12L24.48 5.63998L26.36 7.51998L17.88 16L26.36 24.48L24.48 26.3733Z"
                        fill="#AAA" />
                </svg>
            </div>

            <form role="form" action="#" method="post" class="e-form">
                @csrf
                <input type="hidden" name="id">
                <div class="e-select">
                    <div class="e-box expense active">
                        <p class="e-text">Expense</p>
                    </div>

                    <div class="e-box income">
                        <p class="e-text">Income</p>
                    </div>
                </div>
                <input type="hidden" name="type">

                <div class="e-input">
                    <input type="date" name="date" placeholder="" autocomplete="off" required>

                    <label class="e-placeholder">Date</label>
                </div>

                <div class="e-input">
                    <select name="category" required>
                        <option value="" selected></option>
                    </select>

                    <label class="e-placeholder">Category</label>

                    <svg class="e-category-icon" viewBox="0 0 448 512">
                        <path
                            d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM200 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                </div>

                <div class="e-input">
                    <input type="number" name="amount" placeholder="" autocomplete="off" required>

                    <label class="e-placeholder">Amount</label>
                </div>

                <div class="e-input">
                    <input type="text" name="content" placeholder="" autocomplete="off" maxlength="50" required>

                    <label class="e-placeholder">Content</label>
                </div>

                <p class="e-submit expense save">Save</p>
                <p class="e-submit delete">Delete</p>
            </form>
        </div>
    </section>

    <section class="e-modal">
        <form class="e-form" role="form" action="">
            @csrf

            <div class="e-select">
                <div class="e-box new active">
                    <p class="e-text">New</p>
                </div>

                <div class="e-box modify">
                    <p class="e-text">Modify</p>
                </div>
            </div>
            <input type="hidden" name="newModify">

            <div class="e-select">
                <div class="e-box expense active">
                    <p class="e-text">Expense</p>
                </div>

                <div class="e-box income">
                    <p class="e-text">Income</p>
                </div>
            </div>
            <input type="hidden" name="type">

            <div class="e-input modify">
                <select name="category">
                    <option value="" selected></option>
                </select>

                <label class="e-placeholder">Category</label>
            </div>

            <div class="e-input new">
                <input type="text" name="name" placeholder="" autocomplete="off" required>

                <label class="e-placeholder">Name</label>
            </div>

            <p class="e-submit expense save">Save</p>
            <p class="e-submit delete">Delete</p>
        </form>
    </section>

    <script type="module" src="{{ asset('/js/dashboard.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    <script>
        let items = @json($items);
        let categories = @json($categories);
        let datePerItems;
        let eventData;
    </script>
@endsection
