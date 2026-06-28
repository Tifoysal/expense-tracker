<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <!-- Include stylesheet -->
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    @notifyCss
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro|Roboto&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>


    @livewireStyles
    
    <style>
        .inset-0 {
            top: auto !important;
        }
    </style>
    @stack('css')
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }
    </style>

    <style>
        @media print {
            body {
                font-size: 9px;
                line-height: 1.1;
                margin: 0;
                padding: 0;
            }

            .print-area {
                padding: 0 !important;
                margin: 0 !important;
            }

            .container {
                max-width: 100% !important;
                padding: 0 6px !important;
            }

            table {
                font-size: 9px !important;
                margin-bottom: 6px !important;
            }

            td,
            th {
                padding: 2px 4px !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                margin: 2px 0 !important;
                font-size: 12px !important;
            }

            .mb-10,
            .mb-12,
            .mt-16,
            .mt-20,
            .mb-8 {
                margin: 4px 0 !important;
            }

            .print\:w-full {
                width: 100% !important;
            }

            .print\:shadow-none {
                box-shadow: none !important;
            }

            .print\:p-0 {
                padding: 0 !important;
            }

            .print\:bg-white {
                background-color: white !important;
            }

            .no-print,
            .print-hidden {
                display: none !important;
            }
        }
    </style>


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="antialiased">
    <div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ open: false, showModal: false }">
        <!-- Off-canvas menu for mobile -->


        <!-- Static sidebar for desktop -->
        @includeIf('backend.partials.sidebar')
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="no-print">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button @click="open=true"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
                        aria-label="Open sidebar">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
            <main class="flex-1 relative z-0 overflow-y-auto pb-6 focus:outline-none" tabindex="0">
                <div class="no-print">
                    <div class="shadow-lg bg-white flex justify-between lg:px-8 mx-auto p-5 px-4 sm:px-6 text-black">
                        <!-- <div class=" font-semibold text-2xl inline-block">My Team</div> -->
                        <div class="text-2xl font-bold">
                            @yield('title')
                            <!-- Dashboard -->
                        </div>


                        <div id="dropdown" class="cursor-pointer">
                            <div class="flex items-center flex-shrink-0 px-4">
                                <img class="border border-black h-8 rounded-full w-auto"
                                    src="{{ asset('backend/images/avatar.png') }}" alt="admin">
                                <!-- <a href="{{ route('user.profile', auth()->user()->id) }}"><span
                                    class=" font-semibold ml-3 inline-block">{{ auth()->user()->full_name }}</span></a> -->
                            </div>
                            <div class="hidden">


                                <ul class="
          dropdown-menu
          min-w-max
          absolute
          bg-white
          text-base
          z-50
          right-12
          list-none
          rounded-lg
          shadow-lg
          drop-shadow-lg
          mt-1
          m-0
          bg-clip-padding
          border-none
          divide-y
          divide-gray-300
          w-[18%]
        "
                                    aria-labelledby="dropdownMenuButton2">
                                    <li>
                                        <span class="font-bold capitalize m-2">hello !</span>

                                        <p class="p-2.5"> {{ auth()->user()->name }}
                                            <span class="text-sm bg-blue-200 text-blue-800 rounded-xl p-1"> {{ auth()->user()->role->name }}</span>
                                        </p>

                                    </li>
                                    <li>
                                        <a class="

              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              w-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-gray-100

              flex justify-start
            "
                                            href="{{ route('user.profile', auth()->user()->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span>Profile</span> </a>

                                    </li>
                                    <li>
                                        <a class="
              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              w-full
              h-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-gray-100
              flex items-center
              justify-start
              shadow-sm drop-shadow-sm
            "
                                            href="{{ route('logout') }}">

                                            <svg class="mr-3 h-5 w-5 fill-current text-red-500 group-hover:text-gray-800  transition ease-in-out duration-150"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="22"
                                                height="22">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M6.265 3.807l1.147 1.639a8 8 0 1 0 9.176 0l1.147-1.639A9.988 9.988 0 0 1 22 12c0 5.523-4.477 10-10 10S2 17.523 2 12a9.988 9.988 0 0 1 4.265-8.193zM11 12V2h2v10h-2z" />
                                            </svg>

                                            <span class="text-red-500 font-medium">Logout</span></a>
                                    </li>
                                </ul>


                            </div>
                        </div>

                    </div>
                </div>

                <!-- <div class="max-w-7xl mx-auto px-4 sm:px-6 "> -->
                <!-- Replace with your content -->

                {{-- Laravel 7 or greater --}}
                {{-- <x:notify-messages /> --}}
                @include('notify::components.notify')
                @notifyJs
                <div class="bg-gray-100">
                    <div class="no-print">
                        <ol class="breadcrumb bg-gray-300 breadcrumb m-2 mb-4 mt-4 p-4 rounded shadow-sm">

                            <li class="breadcrumb-item active flex">
                                <a href="{{ route('admin.dashboard') }}" class="flex">
                                    <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M19 21H5a1 1 0 0 1-1-1v-9H1l10.327-9.388a1 1 0 0 1 1.346 0L23 11h-3v9a1 1 0 0 1-1 1zm-6-2h5V9.157l-6-5.454-6 5.454V19h5v-6h2v6z" />
                                    </svg>
                                </a>
                                {{ implode(' / ', array_map('ucfirst', request()->segments())) }}
                            </li>
                        </ol>
                    </div>
                    <div class="m-2">
                    @yield('content')
                    </div>
                </div>
                <!-- /End replace -->
            </main>
        </div>
    </div>
    @stack('js')

    <script src="https://unpkg.com/flowbite@1.4.6/dist/datepicker.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('backend/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <script src="{{ asset('backend/js/app.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    </script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(".select_with_search").select2({
            placeholder: "Select Option",
            allowClear: true
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.ckeditor');

            if (elements.length === 0) return;

            window.editors = [];

            elements.forEach((el, idx) => {
                ClassicEditor.create(el)
                    .then(editor => {
                        window.editors.push(editor);
                    })
                    .catch(console.error);
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.sidebar-parent-menu').click(function() {
                // Toggle child div
                const childDiv = $(this).parent().find('.child-menu-div');
                childDiv.slideToggle(200);

                // Rotate arrow icon
                const arrowIcon = $(this).find('.arrow-icon');
                arrowIcon.toggleClass('rotate-180');
            });

            $('.child-menu-div').each(function() {
                if ($(this).find('a.active').length > 0) {
                    $(this).show(); // show child menu
                    $(this).siblings('.sidebar-parent-menu').addClass(
                        'bg-gray-100 text-gray-800'); // mark parent as active
                    $(this).siblings('.sidebar-parent-menu').find('.arrow-icon').addClass(
                        'rotate-180'); // rotate arrow
                }
            });

            const activeLink = $('.child-menu-div a.active');
            if (activeLink.length) {
                const container = $('#sidebar_main_content');
                const offsetTop = activeLink.offset().top - container.offset().top + container.scrollTop() - 100;

                container.animate({
                    scrollTop: offsetTop
                }, 300);
            }
        });
    </script>
    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>



    <script>
        $(document).ready(function() {

            // Default date range: this month
            var start = moment().startOf('month');
            var end = moment().endOf('month');

            // Initialize date range input with default range
            $('#dateRange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));

            // Initialize Date Range Picker with predefined ranges
            $('#dateRange').daterangepicker({
                startDate: start,
                endDate: end,
                autoUpdateInput: false,
                opens: 'left',
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'This Week': [moment().startOf('week'), moment().endOf('week')],
                    'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week')
                        .endOf('week')
                    ],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')]
                }
            });

            // On apply, update input and reload table
            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
                // table.draw();
            });

            // On cancel, clear input and reload table
            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                // table.draw();
            });
        });
    </script>


    @yield('scripts')
</body>

@livewireScripts

</html>